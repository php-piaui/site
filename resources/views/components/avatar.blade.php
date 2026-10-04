{{-- Foto redonda de pessoa com fallback de iniciais (components/content/Avatar). Uso: <x-avatar name="Ana Sousa" :size="36" /> --}}
@props([
    'src' => null,
    'name' => '',
    'size' => 40,
])

@php
    $initials = str($name)->squish()->explode(' ')->filter()->take(2)->map(fn (string $word): string => mb_substr($word, 0, 1))->implode('');
@endphp

<span {{ $attributes->class('pp-avatar')->merge(['style' => "width: {$size}px; height: {$size}px; font-size: ".($size * 0.36).'px']) }}>
    @if ($src)
        <img src="{{ $src }}" alt="">
    @else
        <span aria-hidden="true">{{ mb_strtoupper($initials) }}</span>
    @endif
</span>
