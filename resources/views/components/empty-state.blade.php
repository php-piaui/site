{{--
    Estado vazio (components/feedback/EmptyState): elefante (ou ícone), título amigável e próximo passo.
    Uso: <x-empty-state title="Nenhum evento por aqui" icon="calendar">Volte em breve.<x-slot:actions><x-button>Ver anteriores</x-button></x-slot:actions></x-empty-state>
--}}
@props([
    'title',
    'icon' => null,
    'actions' => null,
])

<div {{ $attributes->class('pp-empty') }}>
    <div class="pp-empty__art" aria-hidden="true">
        @if ($icon)
            <x-icon :name="$icon" :width="36" :height="36" />
        @else
            <x-logo variant="symbol" :size="42" tone="currentColor" title="" />
        @endif
    </div>
    <h3 class="pp-empty__title">{{ $title }}</h3>
    @if ($slot->isNotEmpty())
        <p class="pp-empty__text">{{ $slot }}</p>
    @endif
    @if ($actions)
        <div class="pp-empty__actions">{{ $actions }}</div>
    @endif
</div>
