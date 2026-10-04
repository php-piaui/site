@php
    $cfpOpen = (bool) $event->cfp?->isOpen();
@endphp

<x-layouts.site :title="$event->title" current="eventos">
    <div class="pp-container pb-18">
        <x-page-head :title="$event->title" :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Eventos', 'href' => route('events.index')], ['label' => $event->title]]">
            <div class="flex flex-wrap gap-1.5">
                <x-badge :preset="$event->type->value" />
                <x-badge :preset="$event->modality->value" />
                @if ($cfpOpen)
                    <x-badge preset="cfp-open" />
                @elseif ($event->isPast())
                    <x-badge preset="past" />
                @endif
            </div>
        </x-page-head>
        <div class="flex flex-wrap items-start gap-8">
            <div class="grid min-w-0 flex-[999_1_560px] gap-10">
                <div class="pp-event__media aspect-[21/9] rounded-lg">
                    <div class="pp-event__ph"><x-logo variant="symbol" :size="110" tone="currentColor" title="" /></div>
                </div>
                @if ($event->description)
                    <section class="grid gap-3">
                        <h2 class="text-2xl">Sobre o evento</h2>
                        <p class="max-w-[64ch] text-lg">{{ $event->description }}</p>
                    </section>
                @endif
                @if ($cfpOpen)
                    <x-cfp-banner compact :event-name="$event->title" :deadline-label="$event->cfp->closes_at->format('d/m')" :submit-url="\App\Support\SiteContent::submitUrl()" />
                @endif
                @if ($talks->isNotEmpty())
                    <section>
                        <h2 class="mb-4 text-2xl">Programação</h2>
                        {{-- ponytail: sem horário por palestra ainda; adicione quando o painel montar a grade. --}}
                        <x-schedule :items="$talks->map(fn ($talk) => [
                            'time' => '',
                            'title' => $talk->title,
                            'format' => $talk->format->value,
                            'speakers' => [['name' => $talk->speaker_name, 'role' => $talk->user?->headline, 'photo' => $talk->user?->photoUrl()]],
                        ])->all()" />
                    </section>
                    <section>
                        <h2 class="mb-4 text-2xl">Palestrantes</h2>
                        <div class="grid grid-cols-[repeat(auto-fill,minmax(min(100%,260px),1fr))] gap-4">
                            @foreach ($talks->unique('speaker_name') as $talk)
                                <x-speaker-card :name="$talk->speaker_name" :role="$talk->user?->headline" :bio="$talk->user?->bio" :photo="$talk->user?->photoUrl()" :socials="$talk->user?->socials() ?? []" />
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
            <aside class="pp-card sticky top-22 grid flex-[1_1_300px] gap-4 p-6">
                <ul class="pp-meta gap-3 text-base">
                    <li><x-icon name="calendar" :width="18" :height="18" /><span><b class="text-fg">{{ $event->dateLabel() }}</b><br>{{ $event->timeLabel() }}</span></li>
                    <li><x-icon :name="$event->modality->value === 'online' ? 'video' : 'map-pin'" :width="18" :height="18" /><span>{{ $event->place }}</span></li>
                    <li><x-icon name="ticket" :width="18" :height="18" /><span>Gratuito</span></li>
                </ul>
                @if ($event->register_url && ! $event->isPast())
                    <x-button variant="cta" size="lg" block :href="$event->register_url" external>Inscrever-se</x-button>
                    <p class="text-[13px] leading-[18px] text-fg-muted">A inscrição é feita fora do site da PHP Piauí.</p>
                @endif
            </aside>
        </div>
    </div>
</x-layouts.site>
