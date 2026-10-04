<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cfp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Cadastro público: sempre palestrante. Admin só é atribuído pela organização (ADR 0001 §2.1.1).
 */
class RegistrationController extends Controller
{
    public function create(Request $request): View
    {
        return view('auth.access', ['mode' => 'signup', 'cfp' => $request->boolean('cfp') ? Cfp::open()->with('event')->first() : null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', Password::min(8)],
            'terms'    => ['accepted'],
        ]);

        $user = User::create([
            'name'     => $request->string('name')->toString(),
            'email'    => $request->string('email')->toString(),
            'password' => $request->string('password')->toString(),
        ]);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route($request->boolean('cfp') ? 'proposals.create' : 'proposals.index')
            ->with('status', 'Conta pronta, '.str($user->name)->before(' ').'!');
    }
}
