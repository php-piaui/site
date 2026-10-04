<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cfp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(Request $request): View
    {
        return view('auth.access', ['mode' => 'login', 'cfp' => $request->boolean('cfp') ? Cfp::open()->with('event')->first() : null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages(['email' => 'E-mail ou senha não conferem.']);
        }

        $request->session()->regenerate();

        // Quem veio do CFP volta direto ao formulário de submissão (ADR 0001 §2.3).
        if ($request->boolean('cfp')) {
            return redirect()->route('proposals.create');
        }

        return redirect()->intended($request->user()?->is_admin ? route('admin.proposals') : route('proposals.index'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
