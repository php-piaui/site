<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProposalStatus;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        return view('events.index', [
            'tab'      => $request->query('aba') === 'anteriores' ? 'anteriores' : 'proximos',
            'upcoming' => Event::published()->upcoming()->with('cfp')->get(),
            'past'     => Event::published()->past()->paginate(9)->appends(['aba' => 'anteriores']),
        ]);
    }

    public function show(Event $event): View
    {
        abort_if($event->published_at === null, 404);

        $event->load('cfp');
        $talks = $event->cfp?->proposals()->where('status', ProposalStatus::Approved)->with('user')->oldest('decided_at')->get() ?? collect();

        return view('events.show', ['event' => $event, 'talks' => $talks]);
    }
}
