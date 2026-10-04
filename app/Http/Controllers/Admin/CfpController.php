<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CfpRequest;
use App\Models\Cfp;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CfpController extends Controller
{
    public function create(Request $request): View
    {
        return view('admin.cfp-form', [
            'events'   => Event::upcoming()->whereDoesntHave('cfp')->pluck('title', 'id')->all(),
            'selected' => $request->integer('evento') ?: null,
        ]);
    }

    public function store(CfpRequest $request): RedirectResponse
    {
        Cfp::create([...$request->validated(), 'show_countdown' => $request->boolean('show_countdown')]);

        return redirect()->route('admin.proposals')->with('status', 'CFP aberto');
    }
}
