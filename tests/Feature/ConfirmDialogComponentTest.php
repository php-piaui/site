<?php

declare(strict_types=1);

test('renders a danger dialog as a form with method spoofing', function () {
    $this->blade('<x-confirm-dialog tone="danger" title="Excluir proposta?" action="/propostas/1" method="DELETE" cancel-href="/propostas" confirm-label="Excluir">Não pode ser desfeita.</x-confirm-dialog>')
        ->assertSee('class="pp-overlay"', false)
        ->assertSee('action="/propostas/1"', false)
        ->assertSee('name="_method" value="DELETE"', false)
        ->assertSee('name="_token"', false)
        ->assertSee('pp-dialog__icon pp-dialog__icon--danger', false)
        ->assertSee('href="/propostas"', false)
        ->assertSee('class="pp-btn pp-btn--danger" autofocus', false)
        ->assertSee('Excluir');
});

test('renders brand dialog inline with primary confirm and default labels', function () {
    $this->blade('<x-confirm-dialog title="Aprovar?" action="/a" cancel-href="/b" inline />')
        ->assertSee('class="pp-overlay pp-overlay--inline"', false)
        ->assertSee('class="pp-dialog__icon"', false)
        ->assertSee('pp-btn--primary', false)
        ->assertSee('Confirmar')
        ->assertSee('Cancelar');
});
