<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ProposalStatus;
use App\Http\Controllers\Controller;
use App\Mail\ProposalStatusMail;
use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Aprovação ou recusa manual (ADR 0001 §2.3): muda o status uma única vez e avisa o palestrante por e-mail.
 */
class ProposalDecisionController extends Controller
{
    public function store(Request $request, Proposal $proposal, string $decision): RedirectResponse
    {
        abort_if($proposal->isDecided(), 409, 'Esta proposta já foi decidida.');

        $request->validate(['message' => ['nullable', 'string', 'max:500']]);
        $approved = $decision === 'approve';
        $message  = ! $approved && $request->filled('message') ? $request->string('message')->toString() : null;

        $proposal->decide($approved ? ProposalStatus::Approved : ProposalStatus::Rejected, $message);

        if ($proposal->user) {
            Mail::to($proposal->user)->send(new ProposalStatusMail($proposal));
        }

        return redirect()->route('admin.proposals')->with('status', $approved ? 'Proposta aprovada' : 'Proposta recusada');
    }
}
