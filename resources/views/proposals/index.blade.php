<x-layouts.site title="Minhas propostas" current="minhas">
    <div class="pp-container max-w-[860px] pb-18">
        <x-page-head title="Minhas propostas" lead="Acompanhe o status de tudo o que você enviou. A resposta também chega por e-mail.">
            <div><x-button variant="cta" icon="plus" :href="\App\Support\SiteContent::submitUrl()">Nova proposta</x-button></div>
        </x-page-head>
        @forelse ($proposals as $proposal)
            @php($locked = $proposal->isDecided())
            @if ($loop->first)<ul class="grid gap-3">@endif
            <li @class(['pp-card grid gap-3 p-5', 'bg-sunken shadow-none' => $locked])>
                <div class="flex flex-wrap items-center gap-2">
                    <x-badge :preset="$proposal->status->value" />
                    <x-badge :preset="$proposal->format->value" size="sm" />
                    @if ($locked)
                        <span class="ml-auto inline-flex items-center gap-1 text-[13px] text-fg-muted"><x-icon name="lock" :width="14" :height="14" />Somente leitura</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl leading-[26px]">{{ $proposal->title }}</h2>
                    <p class="mt-1 text-sm text-fg-muted">{{ $proposal->cfp->event->title }} · enviada em {{ $proposal->created_at->format('d/m/Y') }}@if ($proposal->decided_at) · decisão em {{ $proposal->decided_at->format('d/m/Y') }}@endif</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @if ($locked)
                        <x-button variant="secondary" size="sm" icon="eye" :href="route('proposals.show', $proposal)">Ver proposta</x-button>
                    @else
                        <x-button variant="secondary" size="sm" icon="pencil" :href="route('proposals.show', $proposal)">Editar</x-button>
                        <span class="self-center text-[13px] text-fg-muted">Editável enquanto estiver em revisão</span>
                    @endif
                </div>
            </li>
            @if ($loop->last)</ul>@endif
        @empty
            <x-empty-state icon="inbox" title="Você ainda não enviou nenhuma proposta">
                Primeira vez? Uma lightning talk de 5 minutos é um ótimo começo — e o comitê ajuda a lapidar.
                <x-slot:actions>
                    <x-button variant="cta" icon="send" :href="\App\Support\SiteContent::submitUrl()">Submeter proposta</x-button>
                    <x-button variant="ghost" :href="route('cfp.show')">Ver regras do CFP</x-button>
                </x-slot:actions>
            </x-empty-state>
        @endforelse
    </div>
</x-layouts.site>
