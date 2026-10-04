<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Mail\ProposalStatusMail;
use App\Models\Cfp;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ProposalController extends Controller
{
    public function index(#[CurrentUser] User $user): View
    {
        return view('proposals.index', [
            'proposals' => $user->proposals()->with('cfp.event')->latest()->get(),
        ]);
    }

    public function create(#[CurrentUser] User $user): View|RedirectResponse
    {
        $cfp = Cfp::open()->with('event')->first();

        if (! $cfp) {
            return redirect()->route('cfp.show')->with('status', 'Nenhum CFP aberto agora.');
        }

        return view('proposals.form', ['proposal' => null, 'cfp' => $cfp, 'user' => $user]);
    }

    public function store(ProposalRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        $cfp = $request->cfp() ?? abort(404);

        $proposal = new Proposal($request->proposalAttributes());
        $proposal->forceFill(['cfp_id' => $cfp->id, 'user_id' => $user->id, 'speaker_name' => $user->name])->save();

        Mail::to($user)->send(new ProposalStatusMail($proposal));

        return redirect()->route('proposals.index')->with('status', 'Proposta enviada!');
    }

    public function show(#[CurrentUser] User $user, Proposal $proposal): View
    {
        Gate::authorize('view', $proposal);

        return view('proposals.form', ['proposal' => $proposal, 'cfp' => $proposal->cfp->load('event'), 'user' => $user]);
    }

    public function update(ProposalRequest $request, Proposal $proposal): RedirectResponse
    {
        $proposal->update($request->proposalAttributes());

        return redirect()->route('proposals.index')->with('status', 'Alterações salvas');
    }
}
