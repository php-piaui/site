{{-- Ícone Lucide do subconjunto do design system (resources/icons/lucide-subset.json). Uso: <x-icon name="calendar" class="size-4" /> --}}
@props(['name'])

@php
    $icons = once(fn (): array => json_decode(file_get_contents(resource_path('icons/lucide-subset.json')), true));
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    {{ $attributes->merge(['class' => 'shrink-0', 'aria-hidden' => 'true', 'width' => 20, 'height' => 20]) }}
>{!! $icons[$name] ?? throw new InvalidArgumentException("Ícone [{$name}] não existe no subconjunto Lucide.") !!}</svg>
