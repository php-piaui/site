<x-layouts.site :title="$event['title']" current="eventos">
    <div class="pp-container pb-18">
        <x-page-head :title="$event['title']" :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Eventos', 'href' => route('events.index')], ['label' => $event['title']]]">
            <div class="flex flex-wrap gap-1.5">
                <x-badge :preset="$event['type']" />
                <x-badge :preset="$event['modality']" />
                @if ($event['cfp_open'] ?? false)
                    <x-badge preset="cfp-open" />
                @endif
            </div>
        </x-page-head>
        <div class="flex flex-wrap items-start gap-8">
            <div class="grid min-w-0 flex-[999_1_560px] gap-10">
                <div class="pp-event__media aspect-[21/9] rounded-lg">
                    <div class="pp-event__ph"><x-logo variant="symbol" :size="110" tone="currentColor" title="" /></div>
                </div>
                @isset($event['about'])
                    <section class="grid gap-3">
                        <h2 class="text-2xl">Sobre o evento</h2>
                        <p class="max-w-[64ch] text-lg">{{ $event['about'] }}</p>
                    </section>
                @endisset
                @if ($event['cfp_open'] ?? false)
                    <x-cfp-banner compact :event-name="$event['title']" deadline-label="30/10" :submit-url="\App\Support\SiteContent::submitUrl()" />
                @endif
                <section>
                    <h2 class="mb-4 text-2xl">Programação</h2>
                    <x-schedule :items="$schedule" />
                </section>
                <section>
                    <h2 class="mb-4 text-2xl">Palestrantes</h2>
                    <div class="grid grid-cols-[repeat(auto-fill,minmax(min(100%,260px),1fr))] gap-4">
                        @foreach ($speakers as $speaker)
                            <x-speaker-card :name="$speaker['name']" :role="$speaker['role']" :bio="$speaker['bio']" :socials="$speaker['socials']" />
                        @endforeach
                    </div>
                </section>
            </div>
            <aside class="pp-card sticky top-22 grid flex-[1_1_300px] gap-4 p-6">
                <ul class="pp-meta gap-3 text-base">
                    <li><x-icon name="calendar" :width="18" :height="18" /><span><b class="text-fg">{{ $event['date'] }}</b>@isset($event['time'])<br>{{ $event['time'] }}@endisset</span></li>
                    <li><x-icon name="map-pin" :width="18" :height="18" /><span>{{ $event['place'] }}</span></li>
                    <li><x-icon name="ticket" :width="18" :height="18" /><span>Gratuito · vagas limitadas no presencial</span></li>
                </ul>
                @isset($event['register_url'])
                    <x-button variant="cta" size="lg" block :href="$event['register_url']" external>Inscrever-se</x-button>
                    <p class="text-[13px] leading-[18px] text-fg-muted">A inscrição é feita no Sympla. Você sai do site da PHP Piauí.</p>
                @endisset
            </aside>
        </div>
    </div>
</x-layouts.site>
