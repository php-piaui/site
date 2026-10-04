{{--
    Trilha de navegação (components/navigation/Breadcrumbs); o último item é a página atual.
    items: [['label' => 'Eventos', 'href' => route('events.index')], ['label' => 'PHP Piauí #12']]
    Uso: <x-breadcrumbs :items="$items" />
--}}
@props(['items' => []])

<nav aria-label="Você está em" {{ $attributes }}>
    <ol class="pp-crumbs">
        @foreach ($items as $item)
            <li>
                @if ($loop->last)
                    <span aria-current="page">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['href'] ?? '#' }}">{{ $item['label'] }}</a>
                    <x-icon name="chevron-right" :width="14" :height="14" />
                @endif
            </li>
        @endforeach
    </ol>
</nav>
