<?php

declare(strict_types=1);

use App\Enums\EventType;
use App\Models\Cfp;
use App\Models\Event;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('renders public pages with the next event and the open cfp', function () {
    $cfp = Cfp::factory()->for(Event::factory()->state(['title' => 'PHP Piauí Conf', 'type' => EventType::Evento]))->create();

    $this->get('/')->assertOk()->assertSee('PHP Piauí Conf')->assertSee('Call for papers aberto · PHP Piauí Conf');
    $this->get('/cfp')->assertOk()->assertSee('Call for papers · PHP Piauí Conf')->assertSee($cfp->deadlineLabel());
    $this->get('/apoiadores')->assertOk()->assertSee('Cajutec');
    $this->get('/codigo-de-conduta')->assertOk()->assertSee('O que não aceitamos');
    $this->get('/privacidade')->assertOk()->assertSee('Seus direitos');
});

test('renders empty states without events or cfp', function () {
    $this->get('/')->assertOk()->assertSee('Nenhum evento marcado por enquanto')->assertDontSee('Call for papers aberto');
    $this->get('/eventos')->assertOk()->assertSee('Nenhum evento marcado por enquanto');
    $this->get('/cfp')->assertOk()->assertSee('Nenhum CFP aberto agora');
});

test('lists upcoming and past published events, hiding drafts', function () {
    Event::factory()->create(['title' => 'Meetup futuro']);
    Event::factory()->past()->create(['title' => 'Meetup antigo']);
    Event::factory()->draft()->create(['title' => 'Meetup rascunho']);

    $this->get('/eventos')->assertSee('Meetup futuro')->assertDontSee('Meetup antigo')->assertDontSee('Meetup rascunho');
    $this->get('/eventos?aba=anteriores')->assertSee('Meetup antigo')->assertDontSee('Meetup futuro');
});

test('shows approved talks and their speakers on the event page', function () {
    $cfp     = Cfp::factory()->create();
    $speaker = User::factory()->create(['name' => 'Ana Sousa', 'headline' => 'Dev backend', 'github' => 'anasousa']);
    Proposal::factory()->for($cfp)->for($speaker)->approved()->create(['title' => 'Filas no Laravel']);
    Proposal::factory()->for($cfp)->create(['title' => 'Ainda em revisão']);

    $this->get(route('events.show', $cfp->event))
        ->assertOk()
        ->assertSee('Filas no Laravel')
        ->assertSee('Dev backend')
        ->assertSee('href="https://github.com/anasousa"', false)
        ->assertDontSee('Ainda em revisão');
});

test('hides draft events', function () {
    $this->get(route('events.show', Event::factory()->draft()->create()))->assertNotFound();
});

test('explains why an account is needed before guests submit a proposal', function () {
    Cfp::factory()->create();

    $this->get('/cfp')
        ->assertSee('href="'.route('cfp.show', ['conta' => 1]).'"', false)
        ->assertDontSee('Para enviar sua proposta, você vai precisar de uma conta');

    $this->get('/cfp?conta=1')
        ->assertSee('Para enviar sua proposta, você vai precisar de uma conta')
        ->assertSee('href="'.route('login', ['cfp' => 1]).'"', false)
        ->assertSee('href="'.route('register', ['cfp' => 1]).'"', false);
});

test('repeats the cfp context on login and signup', function () {
    Cfp::factory()->for(Event::factory()->state(['title' => 'PHP Piauí Conf']))->create();

    $this->get('/entrar?cfp=1')->assertSee('Entre para submeter sua proposta ao CFP do')->assertSee('name="cfp" value="1"', false);
    $this->get('/cadastro')
        ->assertDontSee('para submeter sua proposta ao CFP do')
        ->assertSee('Li e aceito o <a href="'.route('conduct').'">código de conduta</a>', false);
});

test('sends guests to login and blocks speakers from the admin panel', function () {
    $this->get('/propostas')->assertRedirect(route('login'));
    $this->get('/admin')->assertRedirect(route('login'));
    $this->actingAs(User::factory()->create())->get('/admin')->assertForbidden();
});
