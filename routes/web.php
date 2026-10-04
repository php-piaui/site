<?php

declare(strict_types=1);

use App\Support\SiteContent;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

// ponytail: só as telas (ui_kits/site do design system); os POSTs dos formulários chegam junto com models e auth.

Route::get('/', fn () => view('home', [
    'event'      => SiteContent::events()['conf26'],
    'cfp'        => SiteContent::cfp(),
    'supporters' => SiteContent::supporters(),
]))->name('home');

Route::get('/eventos', function () {
    $past = collect(SiteContent::pastEvents())->values();
    $page = LengthAwarePaginator::resolveCurrentPage();

    return view('events.index', [
        'tab'      => request('aba') === 'anteriores' ? 'anteriores' : 'proximos',
        'upcoming' => SiteContent::events(),
        'past'     => new LengthAwarePaginator($past->forPage($page, 6), $past->count(), 6, $page, ['path' => route('events.index'), 'query' => ['aba' => 'anteriores']]),
    ]);
})->name('events.index');

Route::get('/eventos/{event}', fn (string $event) => view('events.show', [
    'event'    => (SiteContent::events() + SiteContent::pastEvents())[$event] ?? abort(404),
    'schedule' => SiteContent::schedule(),
    'speakers' => SiteContent::speakers(),
]))->name('events.show');

Route::get('/cfp', fn () => view('cfp.show', [
    'cfp'            => SiteContent::cfp(),
    'explainAccount' => request()->boolean('conta') && auth()->guest(),
]))->name('cfp.show');

Route::get('/entrar', fn () => view('auth.access', ['mode' => 'login', 'cfp' => request()->boolean('cfp') ? SiteContent::cfp() : null]))->name('login');
Route::get('/cadastro', fn () => view('auth.access', ['mode' => 'signup', 'cfp' => request()->boolean('cfp') ? SiteContent::cfp() : null]))->name('register');

Route::get('/propostas', fn () => view('proposals.index', ['proposals' => SiteContent::myProposals()]))->name('proposals.index');
Route::get('/propostas/nova', fn () => view('proposals.form', ['proposal' => null, 'cfp' => SiteContent::cfp()]))->name('proposals.create');
Route::get('/propostas/{proposal}', fn (int $proposal) => view('proposals.form', [
    'proposal' => SiteContent::myProposals()[$proposal] ?? abort(404),
    'cfp'      => SiteContent::cfp(),
]))->name('proposals.show');

Route::get('/perfil', fn () => view('profile.edit', ['confirmDelete' => request()->boolean('excluir')]))->name('profile.edit');

Route::get('/apoiadores', fn () => view('supporters', [
    'supporters' => collect(SiteContent::supporters())->sortBy('name')->values()->all(),
]))->name('supporters');

Route::view('/codigo-de-conduta', 'legal.conduct')->name('conduct');
Route::view('/privacidade', 'legal.privacy')->name('privacy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $proposals = collect(SiteContent::proposals());
        $status    = in_array(request('status'), ['review', 'approved', 'rejected'], true) ? request('status') : 'todas';

        return view('admin.proposals', [
            'status'    => $status,
            'counts'    => $proposals->countBy('status')->put('todas', $proposals->count()),
            'proposals' => $proposals->when($status !== 'todas', fn ($all) => $all->where('status', $status))
                ->map(fn (array $proposal): array => $proposal + ['url' => '#', 'approve_url' => '#', 'reject_url' => '#'])
                ->values()->all(),
        ]);
    })->name('proposals');

    Route::get('/eventos', fn () => view('admin.events', [
        'events' => [...array_values(SiteContent::events()), ...array_slice(array_values(SiteContent::pastEvents()), 0, 3)],
    ]))->name('events');
    Route::view('/eventos/novo', 'admin.event-form')->name('events.create');
    Route::get('/cfp/novo', fn () => view('admin.cfp-form', ['events' => collect(SiteContent::events())->pluck('title', 'id')->all()]))->name('cfp.create');
});
