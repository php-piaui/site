<?php

declare(strict_types=1);

test('renders the elephant by default', function () {
    $this->blade('<x-empty-state title="Nada por aqui" />')
        ->assertSee('<h3 class="pp-empty__title">Nada por aqui</h3>', false)
        ->assertSee('viewBox="2 2 224 180"', false)
        ->assertDontSee('pp-empty__text', false);
});

test('renders icon, text and actions', function () {
    $this->blade('<x-empty-state title="Sem eventos" icon="calendar">Volte em breve.<x-slot:actions><a href="/e">Ver anteriores</a></x-slot:actions></x-empty-state>')
        ->assertSee('width="36"', false)
        ->assertSee('<p class="pp-empty__text">Volte em breve.</p>', false)
        ->assertSee('<div class="pp-empty__actions"><a href="/e">Ver anteriores</a></div>', false);
});
