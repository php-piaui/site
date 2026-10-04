<x-layouts.admin :title="$proposal->title" current="propostas">
    <x-breadcrumbs :items="[['label' => 'Propostas', 'href' => route('admin.proposals')], ['label' => $proposal->title]]" />
    <div class="grid gap-3">
        <span class="pp-eyebrow">CFP · {{ $proposal->cfp->event->title }}</span>
        <h1 class="text-3xl">{{ $proposal->title }}</h1>
        <div class="flex flex-wrap gap-2">
            <x-badge :preset="$proposal->status->value" />
            <x-badge :preset="$proposal->format->value" />
            <x-badge>{{ $proposal->level }}</x-badge>
            @if ($proposal->first_talk)
                <x-badge tone="caju" icon="sparkles">Primeira palestra</x-badge>
            @endif
        </div>
    </div>
    <div class="pp-card grid max-w-[760px] gap-5 p-7">
        <div class="flex items-center gap-3.5">
            <x-avatar :name="$proposal->speaker_name" :src="$proposal->user?->photoUrl()" :size="44" />
            <div>
                <b>{{ $proposal->speaker_name }}</b>
                <div class="text-sm text-fg-muted">{{ $proposal->user?->headline ?? 'Conta excluída' }} · enviada em {{ $proposal->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        <section class="grid gap-1.5">
            <h2 class="text-lg">Resumo para o público</h2>
            <p class="whitespace-pre-line">{{ $proposal->summary }}</p>
        </section>
        @if ($proposal->notes)
            <section class="grid gap-1.5">
                <h2 class="text-lg">Notas para o comitê</h2>
                <p class="whitespace-pre-line text-fg-muted">{{ $proposal->notes }}</p>
            </section>
        @endif
        @if ($proposal->decision_message)
            <section class="grid gap-1.5">
                <h2 class="text-lg">Mensagem enviada</h2>
                <p class="whitespace-pre-line text-fg-muted">{{ $proposal->decision_message }}</p>
            </section>
        @endif
        @unless ($proposal->isDecided())
            <div class="flex flex-wrap justify-end gap-2">
                <x-button variant="secondary" icon="x" :href="route('admin.proposals', ['decidir' => $proposal->id, 'acao' => 'reject'])">Recusar</x-button>
                <x-button variant="primary" icon="check" :href="route('admin.proposals', ['decidir' => $proposal->id, 'acao' => 'approve'])">Aprovar</x-button>
            </div>
        @endunless
    </div>
</x-layouts.admin>
