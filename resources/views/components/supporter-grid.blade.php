{{--
    Grade de apoiadores em um só nível (components/content/SupporterGrid). Cada logo fica numa caixa 3:2 idêntica.
    supporters: [['name' => 'Cajutec', 'logo' => asset('images/supporters/cajutec.webp'), 'url' => '...', 'shape' => 'wide'|'square'|'tall']]
    Uso: <x-supporter-grid :supporters="$supporters" />
--}}
@props(['supporters' => []])

<ul {{ $attributes->class('pp-supporters') }}>
    @foreach ($supporters as $supporter)
        @php
            $classes = ['pp-supporter', 'pp-supporter--square' => ($supporter['shape'] ?? null) === 'square', 'pp-supporter--tall' => ($supporter['shape'] ?? null) === 'tall'];
        @endphp
        <li>
            @if (! empty($supporter['url']))
                <a @class($classes) href="{{ $supporter['url'] }}" target="_blank" rel="noopener noreferrer" title="{{ $supporter['name'] }}">
                    @include('components.supporter-grid.logo')
                    <span class="sr-only"> (abre em outro site)</span>
                </a>
            @else
                <div @class($classes)>@include('components.supporter-grid.logo')</div>
            @endif
        </li>
    @endforeach
</ul>
