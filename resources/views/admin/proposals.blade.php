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
</x-layouts.admin>
