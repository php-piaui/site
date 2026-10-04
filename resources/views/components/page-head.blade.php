{{--
    Cabeçalho de página do site (PageHead em ui_kits/site/HomeScreen.jsx): trilha, sobretítulo, h1, lead e ações no slot.
    Uso: <x-page-head title="Eventos" lead="Meetups mensais…" :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Eventos']]" />
--}}
@props(['title', 'crumbs' => null, 'eyebrow' => null, 'lead' => null])

<div {{ $attributes->class('grid gap-3 pt-8 pb-7') }}>
    @if ($crumbs)
        <x-breadcrumbs :items="$crumbs" />
    @endif
    @if ($eyebrow)
        <span class="pp-eyebrow">{{ $eyebrow }}</span>
    @endif
    <h1>{{ $title }}</h1>
    @if ($lead)
        <p class="max-w-[60ch] text-lg text-fg-muted">{{ $lead }}</p>
    @endif
    {{ $slot }}
</div>
