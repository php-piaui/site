{{--
    Botão / link-botão do design system (components/actions/Button). Renderiza <a> quando há href.
    variant: cta (caju, só a ação principal da tela) · primary · secondary · ghost · link · danger
    size: sm (36px, só tabelas densas) · md (44px) · lg (52px)
    Uso: <x-button variant="cta" size="lg" icon="send">Submeter proposta</x-button>
         <x-button variant="cta" href="https://sympla.com.br/..." external>Inscrever-se</x-button>
         <x-button variant="ghost" icon-only icon="x" label="Fechar" />
--}}
@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'external' => false,
    'icon' => null,
    'iconRight' => null,
    'loading' => false,
    'disabled' => false,
    'block' => false,
    'iconOnly' => false,
    'label' => null,
    'type' => 'button',
])

@php
    $classes = collect(['pp-btn', "pp-btn--{$variant}"])
        ->when($size !== 'md', fn ($c) => $c->push("pp-btn--{$size}"))
        ->when($block, fn ($c) => $c->push('pp-btn--block'))
        ->when($iconOnly, fn ($c) => $c->push('pp-btn--icon'))
        ->implode(' ');
    $iconSize = $size === 'sm' ? 16 : 18;
    $isLink = $href && ! $disabled;
@endphp

<{{ $isLink ? 'a' : 'button' }}
    @if ($isLink)
        href="{{ $href }}"
        @if ($external) target="_blank" rel="noopener noreferrer" @endif
    @else
        type="{{ $type }}"
        @disabled($disabled)
        @if ($loading) aria-busy="true" @endif
    @endif
    @if ($iconOnly) aria-label="{{ $label }}" @endif
    {{ $attributes->class($classes) }}
>
    @if ($loading)
        <x-icon name="loader-circle" class="pp-spin" :width="$iconSize" :height="$iconSize" />
    @elseif ($icon)
        <x-icon :name="$icon" :width="$iconSize" :height="$iconSize" />
    @endif
    @if ($iconOnly)
        <span class="sr-only">{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
    @if (! $loading && $iconRight)
        <x-icon :name="$iconRight" :width="$iconSize" :height="$iconSize" />
    @endif
    @if ($external && ! $iconOnly)
        <x-icon name="external-link" class="pp-btn__ext" :width="$iconSize - 2" :height="$iconSize - 2" />
        <span class="sr-only"> (abre em outro site)</span>
    @endif
</{{ $isLink ? 'a' : 'button' }}>
