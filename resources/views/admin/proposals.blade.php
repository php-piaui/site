<x-layouts.admin title="Propostas" current="propostas">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            @if ($cfp)
                <span class="pp-eyebrow">CFP · {{ $cfp->event->title }}</span>
            @endif
            <h1 class="mt-1 text-3xl">Propostas</h1>
        </div>
        <form method="GET" action="{{ route('admin.proposals') }}" role="search">
            @if ($status !== 'todas')
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <x-text-field name="busca" icon="search" :value="$search" placeholder="Buscar por título ou nome" aria-label="Buscar propostas" />
        </form>
    </div>
    @if ($cfp)
        <x-tabs label="Filtrar" :value="$status" :tabs="collect([
            'todas' => 'Todas',
            'review' => 'Em revisão',
            'approved' => 'Aprovadas',
            'rejected' => 'Recusadas',
        ])->map(fn ($label, $value) => [
            'value' => $value,
            'label' => $label,
            'href' => route('admin.proposals', array_filter(['status' => $value === 'todas' ? null : $value, 'busca' => $search])),
            'count' => $value === 'todas' ? $counts->sum() : ($counts[$value] ?? 0),
        ])->values()->all()" />
        @if ($proposals)
            <x-proposal-table :proposals="$proposals" />
        @else
            <x-empty-state icon="inbox" title="Nenhuma proposta por aqui">As propostas enviadas ao CFP aparecem nesta lista.</x-empty-state>
        @endif
    @else
        <x-empty-state icon="megaphone" title="Nenhum CFP aberto ainda">
            Abra o call for papers de um evento para começar a receber propostas.
            <x-slot:actions><x-button variant="primary" icon="megaphone" :href="route('admin.cfp.create')">Abrir CFP</x-button></x-slot:actions>
        </x-empty-state>
    @endif

    @if ($decision)
        <x-confirm-dialog
            :tone="$decision['approve'] ? 'success' : 'danger'"
            :title="$decision['approve'] ? 'Aprovar esta proposta?' : 'Recusar esta proposta?'"
            :action="route('admin.proposals.decide', [$decision['proposal'], $decision['approve'] ? 'approve' : 'reject'])"
            :cancel-href="$listUrl"
            :confirm-label="$decision['approve'] ? 'Aprovar proposta' : 'Recusar proposta'"
        >
            <div class="grid gap-3.5">
                <p><b class="text-fg">“{{ $decision['proposal']->title }}”</b> · {{ $decision['proposal']->speaker_name }}</p>
                <p>{{ $decision['approve'] ? 'A pessoa recebe um e-mail de confirmação e a proposta fica somente leitura.' : 'A pessoa recebe um e-mail com a decisão. A proposta fica somente leitura e não dá para desfazer.' }}</p>
                @unless ($decision['approve'])
                    <x-text-area name="message" label="Mensagem para a pessoa" optional :rows="3" :max-length="500" hint="Entra no e-mail. Seja gentil e específico." />
                @endunless
            </div>
        </x-confirm-dialog>
        <script>document.addEventListener('keydown', event => event.key === 'Escape' && location.assign(@js($listUrl)));</script>
    @endif
</x-layouts.admin>
