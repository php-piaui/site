{{--
    Cabeçalho do site (components/navigation/SiteHeader): navegação + menu hambúrguer abaixo de 900px.
    current = key do link ativo. Sem usuário logado mostra "Entrar" (login-href, padrão route('login') se existir).
    layout: auto · desktop · mobile
    Uso: <x-site-header current="eventos" />
         <x-site-header :links="[['key' => 'eventos', 'label' => 'Eventos', 'href' => route('events.index')]]" account-href="/conta" />
--}}
@props([
    'links' => [
        ['key' => 'eventos', 'label' => 'Eventos', 'href' => '#eventos'],
        ['key' => 'cfp', 'label' => 'Call for papers', 'href' => '#cfp'],
        ['key' => 'apoiadores', 'label' => 'Apoiadores', 'href' => '#apoiadores'],
        ['key' => 'sobre', 'label' => 'Sobre', 'href' => '#sobre'],
    ],
    'current' => null,
    'layout' => 'auto',
    'homeHref' => null,
    'loginHref' => null,
    'accountHref' => '#',
])

@php
    $user = auth()->user();
    $homeHref ??= url('/');
    $loginHref ??= Route::has('login') ? route('login') : null;
@endphp

<header {{ $attributes->class(['pp-header', "pp-header--{$layout}"]) }}>
    <div class="pp-header__inner">
        <a class="pp-header__brand" href="{{ $homeHref }}" aria-label="PHP Piauí — início">
            <x-logo :size="34" />
        </a>
        <nav class="pp-header__nav" aria-label="Principal">
            @foreach ($links as $link)
                <a class="pp-navlink" href="{{ $link['href'] }}" @if ($current === $link['key']) aria-current="page" @endif>{{ $link['label'] }}</a>
            @endforeach
        </nav>
        <div class="pp-header__actions">
            @if ($user)
                <x-button variant="ghost" icon="user-round" :href="$accountHref">{{ str($user->name)->before(' ')->toString() ?: 'Minha conta' }}</x-button>
            @elseif ($loginHref)
                <x-button variant="secondary" icon="log-in" :href="$loginHref">Entrar</x-button>
            @endif
        </div>
        @if ($layout !== 'desktop')
            <span class="pp-header__burger">
                <x-button
                    variant="ghost"
                    icon-only
                    icon="menu"
                    label="Abrir menu"
                    aria-expanded="false"
                    aria-controls="pp-mobilenav"
                    onclick="const nav = document.getElementById('pp-mobilenav'); nav.hidden = ! nav.hidden; this.setAttribute('aria-expanded', ! nav.hidden); this.setAttribute('aria-label', nav.hidden ? 'Abrir menu' : 'Fechar menu')"
                />
            </span>
        @endif
    </div>
    @if ($layout !== 'desktop')
        <nav id="pp-mobilenav" class="pp-mobilenav" aria-label="Principal" hidden>
            @foreach ($links as $link)
                <a class="pp-navlink" href="{{ $link['href'] }}" @if ($current === $link['key']) aria-current="page" @endif>{{ $link['label'] }}</a>
            @endforeach
            <div class="pp-mobilenav__actions">
                @if ($user)
                    <x-button variant="secondary" block icon="user-round" :href="$accountHref">Minha conta</x-button>
                @elseif ($loginHref)
                    <x-button variant="secondary" block icon="log-in" :href="$loginHref">Entrar</x-button>
                @endif
            </div>
        </nav>
    @endif
</header>
