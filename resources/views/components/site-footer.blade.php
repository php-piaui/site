{{--
    Rodapé com canais oficiais (components/navigation/SiteFooter). Sempre índigo escuro.
    pages / channels: [['label' => 'Eventos', 'href' => '...']] · channels também levam 'icon'
    Uso: <x-site-footer /> · <x-site-footer :pages="[['label' => 'Eventos', 'href' => route('events.index')]]" />
--}}
@props([
    'pages' => [
        ['label' => 'Eventos', 'href' => '#eventos'],
        ['label' => 'Call for papers', 'href' => '#cfp'],
        ['label' => 'Apoiadores', 'href' => '#apoiadores'],
        ['label' => 'Quero apoiar', 'href' => '#apoiar'],
    ],
    'channels' => [
        ['icon' => 'instagram', 'label' => 'Instagram · @php.piaui', 'href' => 'https://www.instagram.com/php.piaui/'],
        ['icon' => 'youtube', 'label' => 'YouTube · @PHP-Piauí', 'href' => 'https://www.youtube.com/@PHP-Piau%C3%AD'],
        ['icon' => 'linkedin', 'label' => 'LinkedIn', 'href' => 'https://www.linkedin.com/company/phppiaui'],
        ['icon' => 'github', 'label' => 'GitHub · php-piaui', 'href' => 'https://github.com/php-piaui'],
    ],
    'conductHref' => '#conduta',
    'privacyHref' => '#privacidade',
])

<footer {{ $attributes->class('pp-footer') }}>
    <div class="pp-footer__inner">
        <div>
            <x-logo tone="white" :size="40" />
            <p class="pp-footer__tag">Comunidade de quem escreve PHP no Piauí. Encontros abertos, gratuitos e feitos por voluntários.</p>
        </div>
        <nav aria-label="Rodapé">
            <h2>Site</h2>
            <ul>
                @foreach ($pages as $page)
                    <li><a href="{{ $page['href'] }}">{{ $page['label'] }}</a></li>
                @endforeach
            </ul>
        </nav>
        <div>
            <h2>Canais oficiais</h2>
            <ul>
                @foreach ($channels as $channel)
                    <li><a href="{{ $channel['href'] }}" target="_blank" rel="noopener noreferrer"><x-icon :name="$channel['icon']" :width="18" :height="18" />{{ $channel['label'] }}<span class="sr-only"> (abre em outro site)</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="pp-footer__base">
            <span>© {{ now()->year }} PHP Piauí</span>
            <span style="display: flex; gap: 20px"><a href="{{ $conductHref }}">Código de conduta</a><a href="{{ $privacyHref }}">Política de privacidade</a></span>
        </div>
    </div>
</footer>
