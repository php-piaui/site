{{--
    Título de seção com lead e ação à direita (SectionHead em ui_kits/site/HomeScreen.jsx).
    Uso: <x-section-head title="Próximo evento"><x-slot:action><x-button variant="ghost">Todos</x-button></x-slot:action></x-section-head>
--}}
@props(['title', 'lead' => null, 'action' => null])

<div {{ $attributes->class('mb-5 flex flex-wrap items-end justify-between gap-4') }}>
    <div class="grid gap-1.5">
        <h2>{{ $title }}</h2>
        @if ($lead)
            <p class="max-w-[56ch] text-fg-muted">{{ $lead }}</p>
        @endif
    </div>
    {{ $action }}
</div>
