<?php

declare(strict_types=1);

$data = ['nome' => 'João', 'titulo' => 'Meu primeiro pacote', 'evento' => 'PHP Piauí Conf 2026', 'url' => 'https://phppiaui.com.br/minhas-propostas'];

test('renders approved variant with committee message', function () use ($data) {
    $this->view('emails.proposal-status', [...$data, 'status' => 'aprovada', 'mensagem' => 'Mostre o composer.json'])
        ->assertSee('Sua proposta foi aprovada, João!')
        ->assertSee('✓&nbsp; Aprovada', false)
        ->assertSee('Mensagem do comitê')
        ->assertSee('href="https://phppiaui.com.br/minhas-propostas"', false);
});

test('renders rejected variant without committee message', function () use ($data) {
    $this->view('emails.proposal-status', [...$data, 'status' => 'recusada'])
        ->assertSee('Desta vez sua proposta não entrou, João')
        ->assertSee('Ver próximos eventos')
        ->assertDontSee('Mensagem do comitê');
});

test('defaults to in-review variant', function () use ($data) {
    $this->view('emails.proposal-status', $data)
        ->assertSee('⏳&nbsp; Em revisão', false)
        ->assertSee('Recebemos sua proposta');
});
