<?php

declare(strict_types=1);

use App\Enums\ProposalFormat;
use App\Enums\ProposalStatus;
use App\Mail\ProposalStatusMail;
use App\Models\Cfp;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

$valid = fn (array $overrides = []): array => [
    'title'      => 'Filas no Laravel sem dor de cabeça',
    'format'     => 'palestra',
    'level'      => 'Iniciante',
    'summary'    => str_repeat('Como tiramos o envio de e-mails do caminho crítico. ', 3),
    'notes'      => '',
    'first_talk' => '1',
    'conduct'    => '1',
    ...$overrides,
];

test('submits a proposal to the open cfp and emails the speaker', function () use ($valid) {
    Mail::fake();
    $cfp  = Cfp::factory()->create();
    $user = User::factory()->create(['name' => 'Ana Sousa']);

    $this->actingAs($user)->post('/propostas', $valid())
        ->assertRedirect(route('proposals.index'))
        ->assertSessionHas('status', 'Proposta enviada!');

    $proposal = Proposal::sole();
    expect($proposal)
        ->cfp_id->toBe($cfp->id)
        ->speaker_name->toBe('Ana Sousa')
        ->status->toBe(ProposalStatus::Review)
        ->first_talk->toBeTrue();
    Mail::assertSent(ProposalStatusMail::class, fn (ProposalStatusMail $mail): bool => $mail->hasTo($user->email));
});

test('rejects formats the cfp does not accept and short summaries', function () use ($valid) {
    Cfp::factory()->create(['formats' => [ProposalFormat::Palestra]]);

    $this->actingAs(User::factory()->create())
        ->post('/propostas', $valid(['format' => 'workshop', 'summary' => 'curto', 'conduct' => null]))
        ->assertSessionHasErrors(['format', 'summary', 'conduct']);

    expect(Proposal::count())->toBe(0);
});

test('redirects to the cfp page when no cfp is open', function () {
    Cfp::factory()->closed()->create();

    $this->actingAs(User::factory()->create())->get('/propostas/nova')->assertRedirect(route('cfp.show'));
});

test('lists only the speaker own proposals', function () {
    $user = User::factory()->create();
    Proposal::factory()->for($user)->create(['title' => 'Minha proposta']);
    Proposal::factory()->create(['title' => 'Proposta de outra pessoa']);

    $this->actingAs($user)->get('/propostas')->assertSee('Minha proposta')->assertDontSee('Proposta de outra pessoa');
});

test('edits a proposal while in review', function () use ($valid) {
    $proposal = Proposal::factory()->create();

    $this->actingAs($proposal->user)->get(route('proposals.show', $proposal))->assertOk()->assertSee('Salvar alterações');
    $this->actingAs($proposal->user)->put(route('proposals.update', $proposal), $valid(['title' => 'Novo título']))
        ->assertRedirect(route('proposals.index'));

    expect($proposal->fresh()->title)->toBe('Novo título');
});

test('keeps decided proposals read only', function () use ($valid) {
    $proposal = Proposal::factory()->approved()->create(['title' => 'Título original']);

    $this->actingAs($proposal->user)->get(route('proposals.show', $proposal))->assertOk()->assertSee('Somente leitura.')->assertDontSee('Salvar alterações');
    $this->actingAs($proposal->user)->put(route('proposals.update', $proposal), $valid())->assertForbidden();

    expect($proposal->fresh()->title)->toBe('Título original');
});

test('hides other people proposals', function () use ($valid) {
    $proposal = Proposal::factory()->create();
    $stranger = User::factory()->create();

    $this->actingAs($stranger)->get(route('proposals.show', $proposal))->assertForbidden();
    $this->actingAs($stranger)->put(route('proposals.update', $proposal), $valid())->assertForbidden();
});

test('limits each speaker to five proposals per cfp', function () use ($valid) {
    $cfp  = Cfp::factory()->create();
    $user = User::factory()->create();
    Proposal::factory()->count(Cfp::MAX_PROPOSALS_PER_SPEAKER)->for($cfp)->for($user)->create();
    Proposal::factory()->for($user)->create();

    $this->actingAs($user)->get('/propostas/nova')->assertRedirect(route('proposals.index'));
    $this->actingAs($user)->post('/propostas', $valid())->assertSessionHasErrors('cfp');

    expect($cfp->proposals()->count())->toBe(Cfp::MAX_PROPOSALS_PER_SPEAKER);
});

test('lets a speaker edit a proposal even at the limit', function () use ($valid) {
    $cfp       = Cfp::factory()->create();
    $user      = User::factory()->create();
    $proposals = Proposal::factory()->count(Cfp::MAX_PROPOSALS_PER_SPEAKER)->for($cfp)->for($user)->create();

    $this->actingAs($user)->put(route('proposals.update', $proposals->first()), $valid(['title' => 'Ajustado']))->assertSessionHasNoErrors();
});
