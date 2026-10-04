<?php

declare(strict_types=1);

use App\Enums\EventModality;
use App\Enums\ProposalFormat;
use App\Models\Cfp;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
});

$valid = fn (array $overrides = []): array => [
    'title'        => 'Meetup #33 — Pest',
    'type'         => 'meetup',
    'modality'     => 'online',
    'date'         => now()->addMonth()->format('Y-m-d'),
    'starts_at'    => '19:00',
    'ends_at'      => '21:30',
    'place'        => 'YouTube',
    'register_url' => 'https://www.sympla.com.br/',
    'description'  => '',
    ...$overrides,
];

test('publishes a new event', function () use ($valid) {
    $this->actingAs($this->admin)->post('/admin/eventos', $valid())
        ->assertRedirect(route('admin.events'))
        ->assertSessionHas('status', 'Evento publicado');

    $event = Event::sole();
    expect($event)
        ->modality->toBe(EventModality::Online)
        ->published_at->not->toBeNull()
        ->and($event->timeLabel())->toBe('19h–21h30');
});

test('saves a draft and validates the times', function () use ($valid) {
    $this->actingAs($this->admin)->post('/admin/eventos', $valid(['draft' => '1']));
    expect(Event::sole()->published_at)->toBeNull();

    $this->actingAs($this->admin)->post('/admin/eventos', $valid(['ends_at' => '18:00', 'type' => 'festa']))
        ->assertSessionHasErrors(['ends_at', 'type']);
});

test('edits an event', function () use ($valid) {
    $event = Event::factory()->create();

    $this->actingAs($this->admin)->get(route('admin.events.edit', $event))->assertOk()->assertSee('value="'.$event->title.'"', false);
    $this->actingAs($this->admin)->put(route('admin.events.update', $event), $valid(['title' => 'Novo nome']))->assertRedirect(route('admin.events'));

    expect($event->fresh()->title)->toBe('Novo nome');
});

test('opens a cfp for an event without one', function () {
    $event = Event::factory()->create();
    $taken = Cfp::factory()->create();

    $this->actingAs($this->admin)->get('/admin/cfp/novo')->assertSee($event->title)->assertDontSee($taken->event->title);

    $this->actingAs($this->admin)->post('/admin/cfp', [
        'event_id'       => $event->id,
        'opens_at'       => now()->format('Y-m-d\TH:i'),
        'closes_at'      => now()->addMonth()->format('Y-m-d\TH:i'),
        'formats'        => ['palestra', 'workshop'],
        'show_countdown' => '1',
    ])->assertRedirect(route('admin.proposals'));

    expect($event->cfp->formats->all())->toBe([ProposalFormat::Palestra, ProposalFormat::Workshop]);
});

test('validates the cfp form', function () {
    $taken = Cfp::factory()->create();

    $this->actingAs($this->admin)->post('/admin/cfp', ['event_id' => $taken->event_id, 'opens_at' => '2026-10-10T10:00', 'closes_at' => '2026-10-01T10:00', 'formats' => ['podcast']])
        ->assertSessionHasErrors(['event_id', 'closes_at', 'formats.0']);
});
