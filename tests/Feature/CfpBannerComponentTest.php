<?php

declare(strict_types=1);

test('renders the countdown until the deadline', function () {
    $this->travelTo('2025-08-10 10:00');

    $this->blade('<x-cfp-banner event-name="PHPeste" deadline-label="15 de agosto" deadline="2025-08-12 13:05" submit-url="/cfp" rules-url="/regras" />')
        ->assertSee('Call for papers aberto · PHPeste')
        ->assertSee('aria-label="Faltam 2 dias, 3 horas e 5 minutos"', false)
        ->assertSee('<b>02</b><span>dias</span>', false)
        ->assertSee('href="/cfp"', false)
        ->assertSee('Ler as regras');
});

test('hides the countdown and rules link when not given', function () {
    $this->blade('<x-cfp-banner event-name="PHPeste" deadline-label="15 de agosto" />')
        ->assertDontSee('pp-countdown', false)
        ->assertDontSee('Ler as regras');
});

test('renders the compact variant', function () {
    $this->blade('<x-cfp-banner compact event-name="PHPeste" deadline-label="15 de agosto" />')
        ->assertSee('pp-cfp pp-cfp--compact', false)
        ->assertSee('Submeta sua palestra para o PHPeste');
});
