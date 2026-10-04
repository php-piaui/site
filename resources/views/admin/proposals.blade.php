<x-layouts.admin title="Propostas" current="propostas">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <span class="pp-eyebrow">CFP · PHP Piauí Conf 2026</span>
            <h1 class="mt-1 text-3xl">Propostas</h1>
        </div>
        <form method="GET" role="search">
            <x-text-field name="busca" icon="search" placeholder="Buscar por título ou nome" aria-label="Buscar propostas" />
        </form>
    </div>
    <x-tabs label="Filtrar" :value="$status" :tabs="[
        ['value' => 'todas', 'label' => 'Todas', 'href' => route('admin.proposals'), 'count' => $counts['todas']],
        ['value' => 'review', 'label' => 'Em revisão', 'href' => route('admin.proposals', ['status' => 'review']), 'count' => $counts['review'] ?? 0],
        ['value' => 'approved', 'label' => 'Aprovadas', 'href' => route('admin.proposals', ['status' => 'approved']), 'count' => $counts['approved'] ?? 0],
        ['value' => 'rejected', 'label' => 'Recusadas', 'href' => route('admin.proposals', ['status' => 'rejected']), 'count' => $counts['rejected'] ?? 0],
    ]" />
    <x-proposal-table :proposals="$proposals" />

    @if ($decision)
        <x-confirm-dialog
            :tone="$decision['approve'] ? 'success' : 'danger'"
            :title="$decision['approve'] ? 'Aprovar esta proposta?' : 'Recusar esta proposta?'"
            :action="$decision['action']"
            :cancel-href="$listUrl"
            :confirm-label="$decision['approve'] ? 'Aprovar proposta' : 'Recusar proposta'"
        >
            <div class="grid gap-3.5">
                <p><b class="text-fg">“{{ $decision['proposal']['title'] }}”</b> · {{ $decision['proposal']['speaker'] }}</p>
                <p>{{ $decision['approve'] ? 'A pessoa recebe um e-mail de confirmação e a proposta fica somente leitura.' : 'A pessoa recebe um e-mail com a decisão. A proposta fica somente leitura e não dá para desfazer.' }}</p>
                @unless ($decision['approve'])
                    <x-text-area name="message" label="Mensagem para a pessoa" optional :rows="3" :max-length="500" hint="Entra no e-mail. Seja gentil e específico." />
                @endunless
            </div>
        </x-confirm-dialog>
        <script>document.addEventListener('keydown', event => event.key === 'Escape' && location.assign(@js($listUrl)));</script>
    @endif
</x-layouts.admin>
