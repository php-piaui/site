<?php

declare(strict_types=1);

test('renders text field with label, hint, icon and counter', function () {
    $this->blade('<x-text-field name="titulo" label="Título" hint="Curto." icon="mail" value="Olá" required placeholder="Ex." :max-length="80" show-count />')
        ->assertSee('<label class="pp-label" for="titulo">', false)
        ->assertSee('<span class="pp-label__req" aria-hidden="true"> *</span>', false)
        ->assertSee('<p class="pp-hint" id="titulo-hint">Curto.</p>', false)
        ->assertSee('class="pp-input-wrap"', false)
        ->assertSee('value="Olá"', false)
        ->assertSee('aria-describedby="titulo-hint"', false)
        ->assertSee('placeholder="Ex."', false)
        ->assertSee('<span class="pp-counter" aria-live="polite">3/80</span>', false);
});

test('text field picks error from the session error bag', function () {
    $this->withViewErrors(['email' => 'E-mail inválido.'])
        ->blade('<x-text-field name="email" label="E-mail" />')
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('aria-describedby="email-error"', false)
        ->assertSee('id="email-error" role="alert"', false)
        ->assertSee('E-mail inválido.');
});

test('text area flags counter over the limit', function () {
    $this->blade('<x-text-area name="resumo" label="Resumo" optional value="abcdef" :max-length="5" />')
        ->assertSee('<span class="pp-label__opt"> (opcional)</span>', false)
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('>abcdef</textarea>', false)
        ->assertSee('<span class="pp-counter pp-counter--over" aria-live="polite">6/5</span>', false);
});

test('select renders placeholder and selects the value', function () {
    $this->blade('<x-select name="formato" placeholder="Escolha…" :options="[\'palestra\' => \'Palestra\', \'workshop\' => \'Workshop\']" value="workshop" />')
        ->assertSee('<option value="" disabled >Escolha…</option>', false)
        ->assertSee('<option value="workshop" selected>Workshop</option>', false)
        ->assertSee('class="shrink-0 pp-select__chev"', false);

    $this->blade('<x-select name="uf" :options="[\'PI\', \'CE\']" />')
        ->assertSee('<option value="CE" >CE</option>', false);
});
