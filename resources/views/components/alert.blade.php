{{--
    Aviso inline de página (components/feedback/Alert). tone: info · success · warning · danger (danger usa role="alert").
    Uso: <x-alert tone="success" title="Proposta enviada">Você receberá um e-mail.</x-alert>
         <x-alert tone="warning" title="CFP fecha amanhã" dismissible><x-slot:action><x-button size="sm">Submeter</x-button></x-slot:action></x-alert>
--}}
@props([
    'tone' => 'info',
    'title' => null,
    'dismissible' => false,
    'action' => null,
])

@php
    $icons = ['info' => 'info', 'success' => 'circle-check', 'warning' => 'triangle-alert', 'danger' => 'circle-alert'];
@endphp

<div role="{{ $tone === 'danger' ? 'alert' : 'status' }}" {{ $attributes->class(['pp-alert', "pp-alert--{$tone}" => $tone !== 'info']) }}>
    <x-icon :name="$icons[$tone]" class="pp-alert__icon" />
    <div style="display: grid; gap: 2px">
        @if ($title)
            <p class="pp-alert__title">{{ $title }}</p>
        @endif
        @if ($slot->isNotEmpty())
            <div class="pp-alert__body">{{ $slot }}</div>
        @endif
        @if ($action)
            <div style="margin-top: 8px">{{ $action }}</div>
        @endif
    </div>
    @if ($dismissible)
        <span class="pp-alert__close"><x-button variant="ghost" icon-only icon="x" label="Fechar aviso" onclick="this.closest('.pp-alert').remove()" /></span>
    @else
        <span></span>
    @endif
</div>
