{{--
    Layout público: cabeçalho, conteúdo e rodapé (ui_kits/site/App.jsx).
    current = key do link ativo no cabeçalho (eventos · cfp · apoiadores · minhas).
    Uso: <x-layouts.site title="Eventos" current="eventos">…</x-layouts.site>
--}}
@props(['title' => null, 'current' => null])

<x-layouts.base :title="$title" class="flex min-h-screen flex-col">
    <x-site-header
        :current="$current"
        :home-href="route('home')"
        :account-href="route('proposals.index')"
        :links="[
            ['key' => 'eventos', 'label' => 'Eventos', 'href' => route('events.index')],
            ['key' => 'cfp', 'label' => 'Call for papers', 'href' => route('cfp.show')],
            ['key' => 'apoiadores', 'label' => 'Apoiadores', 'href' => route('supporters')],
            ...(auth()->check() ? [['key' => 'minhas', 'label' => 'Minhas propostas', 'href' => route('proposals.index')]] : []),
        ]"
    />
    <main class="flex-1">{{ $slot }}</main>
    <x-site-footer
        :pages="[
            ['label' => 'Eventos', 'href' => route('events.index')],
            ['label' => 'Call for papers', 'href' => route('cfp.show')],
            ['label' => 'Apoiadores', 'href' => route('supporters')],
            ['label' => 'Quero apoiar', 'href' => route('supporters').'#apoiar'],
        ]"
        :conduct-href="route('conduct')"
        :privacy-href="route('privacy')"
    />
</x-layouts.base>
