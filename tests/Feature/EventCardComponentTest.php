<?php

declare(strict_types=1);

test('renders an upcoming event with register link', function () {
    $this->blade('<x-event-card title="Meetup #12" modality="online" date="12 de abril" time="19h" place="YouTube" href="/eventos/12" register-url="https://sympla.com.br" cfp-open />')
        ->assertSee('class="pp-card pp-event"', false)
        ->assertSee('<h3 class="pp-event__title"><a href="/eventos/12">Meetup #12</a></h3>', false)
        ->assertSee('12 de abril · 19h')
        ->assertSee('CFP aberto')
        ->assertSee('Inscrever-se')
        ->assertSee('Detalhes');
});

test('renders a past event without register link', function () {
    $this->blade('<x-event-card title="Meetup #1" date="1 de março" past register-url="https://sympla.com.br" :heading-level="2" />')
        ->assertSee('pp-event--past', false)
        ->assertSee('<h2', false)
        ->assertSee('Encerrado')
        ->assertSee('Ver programação')
        ->assertDontSee('Inscrever-se');
});
