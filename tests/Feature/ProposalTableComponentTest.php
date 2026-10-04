<?php

declare(strict_types=1);

$proposals = [
    ['id' => 1, 'title' => 'Pest + Livewire sem sofrimento', 'speaker' => 'Ana Sousa', 'format' => 'palestra', 'sent_at' => '02/10/2026', 'status' => 'review', 'url' => '/p/1', 'approve_url' => '/p/1/approve', 'reject_url' => '/p/1/reject'],
    ['id' => 2, 'title' => 'Meu primeiro pacote no Packagist', 'speaker' => 'João Nunes', 'format' => 'lightning', 'sent_at' => '01/10/2026', 'status' => 'approved', 'url' => '/p/2', 'approve_url' => '/p/2/approve', 'reject_url' => '/p/2/reject'],
];

test('auto layout renders table and stacked cards', function () use ($proposals) {
    $this->blade('<x-proposal-table :proposals="$proposals" />', ['proposals' => $proposals])
        ->assertSee('class="pp-table-wrap pp-table-wrap--auto"', false)
        ->assertSee('<table class="pp-table">', false)
        ->assertSee('<ul class="pp-rows">', false)
        ->assertSee('Pest + Livewire sem sofrimento')
        ->assertSee('Ana Sousa · 02/10/2026')
        ->assertSee('Em revisão')
        ->assertSee('Lightning talk');
});

test('only proposals under review get approve and reject links', function () use ($proposals) {
    $this->blade('<x-proposal-table layout="table" :proposals="$proposals" />', ['proposals' => $proposals])
        ->assertSee('href="/p/1/approve"', false)
        ->assertSee('href="/p/1/reject"', false)
        ->assertDontSee('<form', false)
        ->assertDontSee('/p/2/approve', false)
        ->assertSee('href="/p/2"', false)
        ->assertDontSee('href="/p/1"', false)
        ->assertDontSee('pp-rows', false);
});

test('cards layout uses full-width buttons and a single column for view', function () use ($proposals) {
    $this->blade('<x-proposal-table layout="cards" :proposals="$proposals" />', ['proposals' => $proposals])
        ->assertDontSee('<table', false)
        ->assertSee('class="pp-table-wrap"', false)
        ->assertSee('pp-btn--block', false)
        ->assertSee('class="pp-row-card__actions grid-cols-1"', false);
});
