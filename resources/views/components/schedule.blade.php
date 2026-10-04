{{--
    Programação do evento (components/content/Schedule).
    items: [['time' => '19:00', 'title' => '...', 'kind' => 'talk'|'break', 'format' => 'palestra', 'speakers' => [['name' => '...', 'role' => '...', 'photo' => '...']]]]
    Uso: <x-schedule :items="$items" />
--}}
@props(['items' => []])

<ol {{ $attributes->class('pp-schedule') }}>
    @foreach ($items as $item)
        <li @class(['pp-slot', 'pp-slot--break' => ($item['kind'] ?? null) === 'break'])>
            <time class="pp-slot__time">{{ $item['time'] }}</time>
            <div class="pp-slot__main">
                <p class="pp-slot__title">{{ $item['title'] }}</p>
                @if (! empty($item['format']) || ! empty($item['speakers']))
                    <div class="pp-slot__people">
                        @foreach ($item['speakers'] ?? [] as $speaker)
                            <span class="pp-person">
                                <x-avatar :name="$speaker['name']" :src="$speaker['photo'] ?? null" :size="40" />
                                <span>
                                    <span class="pp-person__name" style="display: block">{{ $speaker['name'] }}</span>
                                    @if (! empty($speaker['role']))
                                        <span class="pp-person__role">{{ $speaker['role'] }}</span>
                                    @endif
                                </span>
                            </span>
                        @endforeach
                        @if (! empty($item['format']))
                            <span style="align-self: center"><x-badge :preset="$item['format']" size="sm" /></span>
                        @endif
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ol>
