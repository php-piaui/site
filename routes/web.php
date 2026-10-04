<?php

declare(strict_types=1);

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CfpController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Support\SiteContent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/eventos/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/cfp', [CfpController::class, 'show'])->name('cfp.show');
Route::get('/apoiadores', fn () => view('supporters', ['supporters' => SiteContent::supporters()]))->name('supporters');
Route::view('/codigo-de-conduta', 'legal.conduct')->name('conduct');
Route::view('/privacidade', 'legal.privacy')->name('privacy');

Route::middleware('guest')->group(function () {
    Route::get('/entrar', [SessionController::class, 'create'])->name('login');
    Route::post('/entrar', [SessionController::class, 'store'])->middleware('throttle:6,1')->name('login.store');
    Route::get('/cadastro', [RegistrationController::class, 'create'])->name('register');
    Route::post('/cadastro', [RegistrationController::class, 'store'])->middleware('throttle:6,1')->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/sair', [SessionController::class, 'destroy'])->name('logout');

    Route::get('/propostas', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('/propostas/nova', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/propostas', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('/propostas/{proposal}', [ProposalController::class, 'show'])->name('proposals.show');
    Route::put('/propostas/{proposal}', [ProposalController::class, 'update'])->name('proposals.update');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\ProposalController::class, 'index'])->name('proposals');
    Route::get('/propostas/{proposal}', [Admin\ProposalController::class, 'show'])->name('proposals.show');
    Route::post('/propostas/{proposal}/{decision}', [Admin\ProposalDecisionController::class, 'store'])->whereIn('decision', ['approve', 'reject'])->name('proposals.decide');

    Route::get('/eventos', [Admin\EventController::class, 'index'])->name('events');
    Route::get('/eventos/novo', [Admin\EventController::class, 'create'])->name('events.create');
    Route::post('/eventos', [Admin\EventController::class, 'store'])->name('events.store');
    Route::get('/eventos/{event}/editar', [Admin\EventController::class, 'edit'])->name('events.edit');
    Route::put('/eventos/{event}', [Admin\EventController::class, 'update'])->name('events.update');

    Route::get('/cfp/novo', [Admin\CfpController::class, 'create'])->name('cfp.create');
    Route::post('/cfp', [Admin\CfpController::class, 'store'])->name('cfp.store');
});
