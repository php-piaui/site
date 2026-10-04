{{--
    Badge pill do design system (components/content/Badge). Use preset para os vocabulários fixos
    (tipo de evento, modalidade, formato, status da proposta); status sempre ícone + texto.
    Uso: <x-badge preset="meetup" /> · <x-badge preset="approved" size="sm" /> · <x-badge tone="success" icon="check">Pago</x-badge>
--}}
@props([
    'preset' => null,
    'tone' => null,
    'icon' => null,
    'size' => 'md',
])

@php
    $presets = [
        'meetup' => ['tone' => 'brand', 'icon' => 'users', 'label' => 'Meetup'],
        'evento' => ['tone' => 'caju', 'icon' => 'presentation', 'label' => 'Evento'],
        'presencial' => ['tone' => 'neutral', 'icon' => 'map-pin', 'label' => 'Presencial'],
        'online' => ['tone' => 'neutral', 'icon' => 'video', 'label' => 'Online'],
        'hibrido' => ['tone' => 'neutral', 'icon' => 'monitor-smartphone', 'label' => 'Híbrido'],
        'palestra' => ['tone' => 'outline', 'icon' => 'mic', 'label' => 'Palestra'],
        'microtalk' => ['tone' => 'outline', 'icon' => 'zap', 'label' => 'Microtalk'],
        'workshop' => ['tone' => 'outline', 'icon' => 'wrench', 'label' => 'Workshop'],
        'review' => ['tone' => 'warning', 'icon' => 'hourglass', 'label' => 'Em revisão'],
        'approved' => ['tone' => 'success', 'icon' => 'circle-check', 'label' => 'Aprovada'],
        'rejected' => ['tone' => 'danger', 'icon' => 'circle-x', 'label' => 'Recusada'],
        'cfp-open' => ['tone' => 'caju', 'icon' => 'megaphone', 'label' => 'CFP aberto'],
        'cfp-closed' => ['tone' => 'neutral', 'icon' => 'lock', 'label' => 'CFP encerrado'],
        'past' => ['tone' => 'neutral', 'icon' => 'clock', 'label' => 'Encerrado'],
    ];
    $config = $presets[$preset] ?? [];
    $tone = $tone ?? $config['tone'] ?? 'neutral';
    $icon = $icon ?? $config['icon'] ?? null;
    $iconSize = $size === 'sm' ? 13 : 14;
@endphp

<span {{ $attributes->class([
    'pp-badge',
    "pp-badge--{$tone}" => $tone !== 'neutral',
    'pp-badge--sm' => $size === 'sm',
]) }}>
    @if ($icon)
        <x-icon :name="$icon" :width="$iconSize" :height="$iconSize" stroke-width="2.25" />
    @endif
    {{ $slot->isEmpty() ? $config['label'] ?? '' : $slot }}
</span>
