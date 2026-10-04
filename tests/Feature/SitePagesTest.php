<?php

declare(strict_types=1);

test('renders every site and admin page', function (string $url, string $text) {
    $this->get($url)->assertOk()->assertSee($text);
})->with([
    'home'               => ['/', 'Gente que escreve PHP, se encontrando no Piauí.'],
    'próximos eventos'   => ['/eventos', 'Meetup #32 — Testes que não quebram'],
    'eventos anteriores' => ['/eventos?aba=anteriores', 'Meetup #27 — Composer além do require'],
    'detalhe do evento'  => ['/eventos/conf26', 'Sobre o evento'],
    'cfp'                => ['/cfp', 'Sua primeira palestra pode ser aqui.'],
    'login'              => ['/entrar', 'Entrar e continuar'],
    'cadastro'           => ['/cadastro', 'Criar conta e continuar'],
    'minhas propostas'   => ['/propostas', 'Arquitetura hexagonal em 40 minutos'],
    'nova proposta'      => ['/propostas/nova', 'Enviar proposta'],
    'perfil'             => ['/perfil', 'Excluir minha conta'],
    'apoiadores'         => ['/apoiadores', 'Quer apoiar a comunidade?'],
    'conduta'            => ['/codigo-de-conduta', 'O que não aceitamos'],
    'privacidade'        => ['/privacidade', 'Seus direitos'],
    'admin propostas'    => ['/admin', 'Observabilidade com OpenTelemetry'],
    'admin eventos'      => ['/admin/eventos', 'Centro de Convenções de Teresina'],
    'admin novo evento'  => ['/admin/eventos/novo', 'Publicar evento'],
    'admin abrir cfp'    => ['/admin/cfp/novo', 'Abrir call for papers'],
]);

test('returns 404 for unknown events and proposals', function (string $url) {
    $this->get($url)->assertNotFound();
})->with(['/eventos/nao-existe', '/propostas/999']);

test('explains why an account is needed before guests submit a proposal', function () {
    $this->get('/cfp')
        ->assertSee('href="'.route('cfp.show', ['conta' => 1]).'"', false)
        ->assertDontSee('Para enviar sua proposta, você vai precisar de uma conta');

    $this->get('/cfp?conta=1')
        ->assertSee('Para enviar sua proposta, você vai precisar de uma conta')
        ->assertSee('href="'.route('login', ['cfp' => 1]).'"', false)
        ->assertSee('href="'.route('register', ['cfp' => 1]).'"', false);
});

test('repeats the cfp context on login and signup', function () {
    $this->get('/entrar?cfp=1')->assertSee('Entre para submeter sua proposta ao CFP do');
    $this->get('/cadastro')
        ->assertDontSee('para submeter sua proposta ao CFP do')
        ->assertSee('Li e aceito o <a href="'.route('conduct').'">código de conduta</a>', false);
});

test('shows decided proposals as read only and keeps proposals in review editable', function () {
    $this->get('/propostas/12')
        ->assertSee('Somente leitura.')
        ->assertDontSee('Salvar alterações');

    $this->get('/propostas/11')
        ->assertSee('Salvar alterações')
        ->assertDontSee('Somente leitura.');
});

test('asks for confirmation before deleting the account', function () {
    $this->get('/perfil')->assertDontSee('Excluir sua conta de vez?');
    $this->get('/perfil?excluir=1')->assertSee('Excluir sua conta de vez?')->assertSee('name="_method" value="DELETE"', false);
});

test('filters admin proposals by status', function () {
    $this->get('/admin?status=approved')
        ->assertSee('Meu primeiro pacote no Packagist')
        ->assertDontSee('Docker para quem tem medo');
});
