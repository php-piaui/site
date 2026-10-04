{{--
    Card de evento (components/content/EventCard): imagem, tipo, modalidade, data/hora, local e "Inscrever-se" externo.
    Uso: <x-event-card title="Meetup #12" type="meetup" modality="presencial" date="12 de abril" time="19h" place="Teresina" href="/eventos/12" register-url="https://sympla.com.br/..." />
--}}
@props([
    'title',
    'type' => 'meetup',
    'modality' => 'presencial',
    'date' => null,
    'time' => null,
    'place' => null,
    'image' => null,
    'registerUrl' => null,
    'past' => false,
    'featured' => false,
    'cfpOpen' => false,
    'href' => '#',
    'headingLevel' => 3,
])

<article {{ $attributes->class(['pp-card pp-event', 'pp-event--past' => $past, 'pp-event--featured' => $featured]) }}>
    <div class="pp-event__media">
        @if ($image)
            <img src="{{ $image }}" alt="">
        @else
            <div class="pp-event__ph"><x-logo variant="symbol" :size="$featured ? 96 : 64" tone="currentColor" title="" /></div>
        @endif
    </div>
    <div class="pp-event__body">
        <div class="pp-event__badges">
            <x-badge :preset="$type" />
            <x-badge :preset="$modality" />
            @if ($cfpOpen && ! $past)
                <x-badge preset="cfp-open" />
            @endif
            @if ($past)
                <x-badge preset="past" />
            @endif
        </div>
        <h{{ $headingLevel }} class="pp-event__title"><a href="{{ $href }}">{{ $title }}</a></h{{ $headingLevel }}>
        <ul class="pp-meta">
            <li><x-icon name="calendar" :width="16" :height="16" /><span>{{ $date }}@if ($time) · {{ $time }}@endif</span></li>
            @if ($place)
                <li><x-icon :name="$modality === 'online' ? 'video' : 'map-pin'" :width="16" :height="16" /><span>{{ $place }}</span></li>
            @endif
        </ul>
        <div class="pp-event__foot">
            @if (! $past && $registerUrl)
                <x-button variant="cta" :href="$registerUrl" external>Inscrever-se</x-button>
            @endif
            <x-button :variant="$past ? 'secondary' : 'ghost'" :href="$href" icon-right="arrow-right">{{ $past ? 'Ver programação' : 'Detalhes' }}</x-button>
        </div>
    </div>
</article>
