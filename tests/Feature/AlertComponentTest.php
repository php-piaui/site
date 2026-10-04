<?php

declare(strict_types=1);

test('renders info alert as status without modifier', function () {
    $this->blade('<x-alert title="Atenção">Corpo do aviso</x-alert>')
        ->assertSee('role="status" class="pp-alert"', false)
        ->assertSee('<p class="pp-alert__title">Atenção</p>', false)
        ->assertSee('<div class="pp-alert__body">Corpo do aviso</div>', false)
        ->assertDontSee('Fechar aviso');
});

test('renders danger alert as alert with dismiss button and action', function () {
    $this->blade('<x-alert tone="danger" title="Erro" dismissible><x-slot:action><a href="/x">Tentar de novo</a></x-slot:action></x-alert>')
        ->assertSee('role="alert" class="pp-alert pp-alert--danger"', false)
        ->assertSee('aria-label="Fechar aviso"', false)
        ->assertSee('Tentar de novo');
});
