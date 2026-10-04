<?php

declare(strict_types=1);

use App\Enums\ProposalStatus;
use App\Mail\ProposalStatusMail;
use App\Models\Cfp;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->cfp   = Cfp::factory()->create();
});

test('filters and searches proposals', function () {
    Proposal::factory()->for($this->cfp)->create(['title' => 'Docker para quem tem medo']);
    Proposal::factory()->for($this->cfp)->approved()->create(['title' => 'Meu primeiro pacote']);

    $this->actingAs($this->admin)->get('/admin?status=approved')->assertSee('Meu primeiro pacote')->assertDontSee('Docker para quem tem medo');
    $this->actingAs($this->admin)->get('/admin?busca=docker')->assertSee('Docker para quem tem medo')->assertDontSee('Meu primeiro pacote');
});

test('asks for confirmation before approving, keeping the filter', function () {
    $proposal = Proposal::factory()->for($this->cfp)->create(['title' => 'Pest + Livewire']);

    $this->actingAs($this->admin)->get('/admin?status=review')
        ->assertSee('href="'.e(route('admin.proposals', ['status' => 'review', 'decidir' => $proposal->id, 'acao' => 'approve'])).'"', false)
        ->assertDontSee('Aprovar esta proposta?');

    $this->actingAs($this->admin)->get("/admin?status=review&decidir={$proposal->id}&acao=approve")
        ->assertSee('Aprovar esta proposta?')
        ->assertSee('action="'.route('admin.proposals.decide', [$proposal, 'approve']).'"', false)
        ->assertSee('href="'.route('admin.proposals', ['status' => 'review']).'"', false)
        ->assertDontSee('Mensagem para a pessoa');
});

test('ignores decision dialogs for decided proposals or unknown actions', function () {
    $approved = Proposal::factory()->for($this->cfp)->approved()->create();
    $review   = Proposal::factory()->for($this->cfp)->create();

    $this->actingAs($this->admin)->get("/admin?decidir={$approved->id}&acao=approve")->assertDontSee('Aprovar esta proposta?');
    $this->actingAs($this->admin)->get("/admin?decidir={$review->id}&acao=delete")->assertDontSee('esta proposta?');
});

test('approves a proposal and emails the speaker', function () {
    Mail::fake();
    $proposal = Proposal::factory()->for($this->cfp)->create();

    $this->actingAs($this->admin)->post(route('admin.proposals.decide', [$proposal, 'approve']))
        ->assertRedirect(route('admin.proposals'))
        ->assertSessionHas('status', 'Proposta aprovada');

    expect($proposal->fresh())->status->toBe(ProposalStatus::Approved)->decided_at->not->toBeNull();
    Mail::assertSent(ProposalStatusMail::class, fn (ProposalStatusMail $mail): bool => $mail->hasTo($proposal->user->email));
});

test('rejects a proposal with a message for the speaker', function () {
    Mail::fake();
    $proposal = Proposal::factory()->for($this->cfp)->create();

    $this->actingAs($this->admin)->get("/admin?decidir={$proposal->id}&acao=reject")->assertSee('Mensagem para a pessoa');
    $this->actingAs($this->admin)->post(route('admin.proposals.decide', [$proposal, 'reject']), ['message' => 'Tente de novo no próximo!']);

    expect($proposal->fresh())->status->toBe(ProposalStatus::Rejected)->decision_message->toBe('Tente de novo no próximo!');
    Mail::assertSent(ProposalStatusMail::class);
});

test('decides each proposal only once', function () {
    $proposal = Proposal::factory()->for($this->cfp)->rejected()->create();

    $this->actingAs($this->admin)->post(route('admin.proposals.decide', [$proposal, 'approve']))->assertStatus(409);
    expect($proposal->fresh()->status)->toBe(ProposalStatus::Rejected);
});

test('shows a proposal with the committee notes', function () {
    $proposal = Proposal::factory()->for($this->cfp)->create(['notes' => 'Já apresentei no PHPeste']);

    $this->actingAs($this->admin)->get(route('admin.proposals.show', $proposal))->assertOk()->assertSee('Já apresentei no PHPeste');
});

test('renders the status email for the decision', function () {
    $proposal = Proposal::factory()->for($this->cfp)->approved()->create(['speaker_name' => 'João Nunes']);

    (new ProposalStatusMail($proposal))->assertHasSubject('Sua proposta foi aprovada')->assertSeeInHtml('Sua proposta foi aprovada, João!');
});
