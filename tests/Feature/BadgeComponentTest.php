<?php

declare(strict_types=1);

test('renders a preset with its tone, icon and label', function () {
    $this->blade('<x-badge preset="approved" size="sm" />')
        ->assertSee('class="pp-badge pp-badge--success pp-badge--sm"', false)
        ->assertSee('width="13"', false)
        ->assertSee('stroke-width="2.25"', false)
        ->assertSee('Aprovada');
});

test('renders outline tone and neutral without modifier', function () {
    $this->blade('<x-badge preset="workshop" />')->assertSee('class="pp-badge pp-badge--outline"', false);
    $this->blade('<x-badge preset="online" />')->assertSee('class="pp-badge"', false);
});

test('slot and explicit tone override the preset', function () {
    $this->blade('<x-badge preset="meetup" tone="danger">Cancelado</x-badge>')
        ->assertSee('pp-badge--danger', false)
        ->assertSee('Cancelado')
        ->assertDontSee('Meetup');
});
