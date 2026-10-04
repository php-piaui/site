<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

test('renders breadcrumbs with the last item as current page', function () {
    $items = [['label' => 'Eventos', 'href' => '/eventos'], ['label' => 'PHP Piauí #12']];

    $this->blade('<x-breadcrumbs :items="$items" />', ['items' => $items])
        ->assertSee('<a href="/eventos">Eventos</a>', false)
        ->assertSee('<span aria-current="page">PHP Piauí #12</span>', false)
        ->assertSee('width="14"', false);
});

test('renders numbered pagination with gaps around the current page', function () {
    $paginator = new LengthAwarePaginator([], 200, 10, 5, ['path' => '/propostas']);

    $this->blade('<x-pagination :paginator="$paginator" />', ['paginator' => $paginator])
        ->assertSee('href="/propostas?page=4" rel="prev"', false)
        ->assertSee('aria-current="page" >5</a>', false)
        ->assertSee('aria-label="Página 20"', false)
        ->assertDontSee('aria-label="Página 3"', false)
        ->assertSee('class="pp-page__gap"', false);
});

test('renders compact pagination with disabled previous on the first page', function () {
    $paginator = new LengthAwarePaginator([], 30, 10, 1, ['path' => '/eventos']);

    $this->blade('<x-pagination :paginator="$paginator" compact />', ['paginator' => $paginator])
        ->assertSee('<span class="pp-page pp-page--nav" aria-disabled="true">', false)
        ->assertSee('Página 1 de 3')
        ->assertSee('href="/eventos?page=2" rel="next"', false);
});

test('renders tabs as links marking the current one', function () {
    $tabs = [
        ['value' => 'review', 'label' => 'Em revisão', 'href' => '?status=review', 'count' => 12],
        ['value' => 'approved', 'label' => 'Aprovadas', 'href' => '?status=approved'],
    ];

    $this->blade('<x-tabs label="Status" :tabs="$tabs" />', ['tabs' => $tabs])
        ->assertSee('<nav aria-label="Status" class="pp-tabs">', false)
        ->assertSee('href="?status=review"  aria-current="page"', false)
        ->assertSee('<span class="pp-tab__count">12</span>', false)
        ->assertDontSee('href="?status=approved"  aria-current', false);
});

test('renders site header for guests with mobile menu', function () {
    $this->blade('<x-site-header current="cfp" login-href="/entrar" />')
        ->assertSee('class="pp-header pp-header--auto"', false)
        ->assertSee('href="#cfp"  aria-current="page"', false)
        ->assertSee('href="/entrar"', false)
        ->assertSee('Entrar')
        ->assertSee('aria-controls="pp-mobilenav"', false)
        ->assertSee('id="pp-mobilenav" class="pp-mobilenav" aria-label="Principal" hidden', false);
});

test('renders site header account button for signed in users', function () {
    $this->actingAs(User::factory()->make(['name' => 'Ana Sousa']));

    $this->blade('<x-site-header layout="desktop" account-href="/conta" />')
        ->assertSee('href="/conta"', false)
        ->assertSee('Ana')
        ->assertDontSee('Entrar')
        ->assertDontSee('pp-mobilenav', false);
});

test('renders site footer with official channels', function () {
    $this->blade('<x-site-footer />')
        ->assertSee('href="https://github.com/php-piaui" target="_blank" rel="noopener noreferrer"', false)
        ->assertSee('(abre em outro site)')
        ->assertSee('<a href="#apoiar">Quero apoiar</a>', false)
        ->assertSee('© '.now()->year.' PHP Piauí', false);
});
