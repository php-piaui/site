{{--
    Abas sublinhadas com contagem opcional (components/navigation/Tabs). Cada aba é um link (ex.: filtro por status via query string).
    tabs: [['value' => 'review', 'label' => 'Em revisão', 'href' => '?status=review', 'count' => 12]]
    Uso: <x-tabs label="Status das propostas" :tabs="$tabs" :value="request('status', 'review')" />
--}}
@props([
    'tabs' => [],
    'value' => null,
    'label' => 'Abas',
])

@php
    $value ??= $tabs[0]['value'] ?? null;
@endphp

<nav aria-label="{{ $label }}" {{ $attributes->class('pp-tabs') }}>
    @foreach ($tabs as $tab)
        <a class="pp-tab" href="{{ $tab['href'] }}" @if ($tab['value'] === $value) aria-current="page" @endif>
            {{ $tab['label'] }}
            @if (isset($tab['count']))
                <span class="pp-tab__count">{{ $tab['count'] }}</span>
            @endif
        </a>
    @endforeach
</nav>
