<?php

declare(strict_types=1);

use App\Models\Cfp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registers a speaker who never becomes admin', function () {
    $this->post('/cadastro', ['name' => 'Ana Sousa', 'email' => 'ana@example.com', 'password' => 'segredo123', 'terms' => '1', 'is_admin' => '1'])
        ->assertRedirect(route('proposals.index'))
        ->assertSessionHas('status', 'Conta pronta, Ana!');

    $this->assertAuthenticated();
    expect(User::firstWhere('email', 'ana@example.com')->is_admin)->toBeFalse();
});

test('validates the signup form', function () {
    User::factory()->create(['email' => 'ana@example.com']);

    $this->post('/cadastro', ['name' => '', 'email' => 'ana@example.com', 'password' => 'curta'])
        ->assertSessionHasErrors(['name', 'email', 'password', 'terms']);

    $this->assertGuest();
});

test('sends people coming from the cfp straight to the submission form', function () {
    Cfp::factory()->create();

    $this->post('/cadastro', ['name' => 'Ana', 'email' => 'ana@example.com', 'password' => 'segredo123', 'terms' => '1', 'cfp' => '1'])
        ->assertRedirect(route('proposals.create'));

    $this->post('/sair');
    $this->post('/entrar', ['email' => 'ana@example.com', 'password' => 'segredo123', 'cfp' => '1'])
        ->assertRedirect(route('proposals.create'));
});

test('logs admins into the panel and rejects wrong passwords', function () {
    $admin = User::factory()->admin()->create();

    $this->post('/entrar', ['email' => $admin->email, 'password' => 'errada'])->assertSessionHasErrors('email');
    $this->assertGuest();

    $this->post('/entrar', ['email' => $admin->email, 'password' => 'password'])->assertRedirect(route('admin.proposals'));
    $this->assertAuthenticatedAs($admin);
});

test('logs out', function () {
    $this->actingAs(User::factory()->create())->post('/sair')->assertRedirect(route('home'));
    $this->assertGuest();
});
