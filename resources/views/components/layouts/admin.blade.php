{{--
    Layout do painel da organização: barra lateral índigo + conteúdo (AdminScreen em ui_kits/site/OtherScreens.jsx).
    current = propostas · eventos · novo · cfp
    Uso: <x-layouts.admin title="Propostas" current="propostas">…</x-layouts.admin>
--}}
@props(['title' => null, 'current' => null])

@php
    $nav = [
        ['key' => 'propostas', 'label' => 'Propostas', 'icon' => 'clipboard-list', 'href' => route('admin.proposals')],
        ['key' => 'eventos', 'label' => 'Eventos', 'icon' => 'calendar', 'href' => route('admin.events')],
        ['key' => 'novo', 'label' => 'Novo evento', 'icon' => 'plus', 'href' => route('admin.events.create')],
        ['key' => 'cfp', 'label' => 'Abrir CFP', 'icon' => 'megaphone', 'href' => route('admin.cfp.create')],
    ];
@endphp

<x-layouts.base :title="$title ? $title.' · Painel' : 'Painel'" class="flex min-h-screen flex-wrap">
    <aside class="flex max-w-full flex-[1_1_220px] flex-col gap-5 bg-indigo-950 px-3 py-5 text-white">
        <div class="flex items-center gap-2.5 px-2">
            <x-logo tone="white" :size="28" />
            <x-badge size="sm" tone="caju">admin</x-badge>
        </div>
        <nav aria-label="Painel" class="flex flex-wrap gap-0.5">
            @foreach ($nav as $item)
                <a
                    href="{{ $item['href'] }}"
                    @if ($current === $item['key']) aria-current="page" @endif
                    @class([
                        'flex min-h-11 flex-[1_1_180px] items-center gap-2.5 rounded-lg px-3 text-[15px] font-medium no-underline',
                        'bg-indigo-300/16 text-white' => $current === $item['key'],
                        'text-indigo-200 hover:text-white' => $current !== $item['key'],
                    ])
                ><x-icon :name="$item['icon']" :width="18" :height="18" />{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="flex min-h-11 w-full cursor-pointer items-center gap-2 px-3 text-sm font-medium text-indigo-200 hover:text-white"><x-icon name="log-out" :width="16" :height="16" />Sair</button>
        </form>
        <a href="{{ route('home') }}" class= flex min-h-11 items-center gap-2 px-3 text-sm font-medium text-indigo-200 no-underline hover:text-white">
            <x-icon name="arrow-left" :width="16" :height="16" />Voltar ao site
        </a>
    </aside>
    <main class="grid min-w-0 flex-[999_1_600px] content-start gap-6 px-[clamp(16px,3vw,40px)] pt-7 pb-16">
        {{ $slot }}
    </main>
</x-layouts.base>
