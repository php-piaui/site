<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        return view('admin.events', ['events' => Event::with('cfp')->latest('starts_at')->get()]);
    }

    public function create(): View
    {
        return view('admin.event-form', ['event' => null]);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $event = Event::create($request->eventAttributes());

        return redirect()->route('admin.events')->with('status', $event->published_at ? 'Evento publicado' : 'Rascunho salvo');
    }

    public function edit(Event $event): View
    {
        return view('admin.event-form', ['event' => $event]);
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        $event->update($request->eventAttributes($event));

        return redirect()->route('admin.events')->with('status', 'Evento atualizado');
    }
}
