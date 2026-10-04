<?php

declare(strict_types=1);

test('renders a success toast inside the region with auto dismiss', function () {
    $this->blade('<x-toast.region><x-toast title="Proposta enviada">Boa sorte!</x-toast></x-toast.region>')
        ->assertSee('aria-live="polite" class="pp-toast-region"', false)
        ->assertSee('role="status" class="pp-toast"', false)
        ->assertSee('pp-toast__icon--success', false)
        ->assertSee('<p class="pp-toast__body">Boa sorte!</p>', false)
        ->assertSee('aria-label="Fechar"', false)
        ->assertSee('5000', false);
});

test('renders a sticky danger toast without close button', function () {
    $this->blade('<x-toast tone="danger" title="Falhou" :duration="0" :dismissible="false" />')
        ->assertSee('role="alert"', false)
        ->assertDontSee('<script>', false)
        ->assertDontSee('Fechar');
});
