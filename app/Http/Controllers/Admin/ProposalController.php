<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ProposalStatus;
use App\Http\Controllers\Controller;
use App\Models\Cfp;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Propostas do CFP mais recente, com filtro por status, busca e confirmação de decisão (?decidir=&acao=).
 */
class ProposalController extends Controller
{
    public function index(Request $request): View
    {
        $cfp     = Cfp::with('event')->latest('opens_at')->first();
        $status  = ProposalStatus::tryFrom((string) $request->query('status'));
        $search  = trim((string) $request->query('busca'));
        $filters = array_filter(['status' => $status?->value, 'busca' => $search]);

        $proposals = Proposal::query()
            ->where('cfp_id', $cfp?->id)
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query->where(fn ($query) => $query->whereLike('title', "%{$search}%")->orWhereLike('speaker_name', "%{$search}%")))
                ->latest()
            ->get();

        $deciding = in_array($request->query('acao'), ['approve', 'reject'], true)
            ? $proposals->where('status', ProposalStatus::Review)->firstWhere('id', $request->integer('decidir'))
            : null;

        return view('admin.proposals', [
            'cfp'       => $cfp,
            'status'    => $status->value ?? 'todas',
            'search'    => $search,
            'counts'    => Proposal::query()->where('cfp_id', $cfp?->id)->toBase()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
            'proposals' => $proposals->map(fn (Proposal $proposal): array => [
                'id'          => $proposal->id,
                'title'       => $proposal->title,
                'speaker'     => $proposal->speaker_name,
                'format'      => $proposal->format->value,
                'sent_at'     => $proposal->created_at?->format('d/m/Y'),
                'status'      => $proposal->status->value,
                'url'         => route('admin.proposals.show', $proposal),
                'approve_url' => route('admin.proposals', [...$filters, 'decidir' => $proposal->id, 'acao' => 'approve']),
                'reject_url'  => route('admin.proposals', [...$filters, 'decidir' => $proposal->id, 'acao' => 'reject']),
            ])->all(),
            'decision' => $deciding ? ['proposal' => $deciding, 'approve' => $request->query('acao') === 'approve'] : null,
            'listUrl'  => route('admin.proposals', $filters),
        ]);
    }

    public function show(Proposal $proposal): View
    {
        return view('admin.proposal', ['proposal' => $proposal->load('cfp.event', 'user')]);
    }
}
