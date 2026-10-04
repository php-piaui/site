<x-layouts.site title="Eventos" current="eventos">
    <div class="pp-container pb-18">
        <x-page-head title="Eventos" lead="Meetups mensais e um evento grande por ano. Os anteriores ficam aqui como histórico, com programação e gravações." />
        <x-tabs label="Eventos" :value="$tab" :tabs="[
            ['value' => 'proximos', 'label' => 'Próximos', 'href' => route('events.index'), 'count' => count($upcoming)],
            ['value' => 'anteriores', 'label' => 'Anteriores', 'href' => route('events.index', ['aba' => 'anteriores']), 'count' => $past->total()],
        ]" />
        <div class="pt-6">
            @if ($tab === 'proximos')
                @forelse ($upcoming as $event)
                    @if ($loop->first)<div class="grid grid-cols-[repeat(auto-fill,minmax(min(100%,320px),1fr))] gap-5">@endif
                    <x-event-card
                        :title="$event['title']"
                        :type="$event['type']"
                        :modality="$event['modality']"
                        :date="$event['date']"
                        :time="$event['time'] ?? null"
                        :place="$event['place']"
                        :register-url="$event['register_url'] ?? null"
                        :cfp-open="$event['cfp_open'] ?? false"
                        :href="route('events.show', $event['id'])"
                    />
                    @if ($loop->last)</div>@endif
                @empty
                    <x-empty-state title="Nenhum evento marcado por enquanto">
                        Estamos organizando o próximo. A data sai primeiro no Instagram @php.piaui.
                        <x-slot:actions>
                            <x-button variant="secondary" icon="instagram" href="https://www.instagram.com/php.piaui/" external>Seguir no Instagram</x-button>
                            <x-button variant="ghost" :href="route('events.index', ['aba' => 'anteriores'])">Ver anteriores</x-button>
                        </x-slot:actions>
                    </x-empty-state>
                @endforelse
            @else
                <div class="grid gap-6">
                    <div class="grid grid-cols-[repeat(auto-fill,minmax(min(100%,280px),1fr))] gap-5">
                        @foreach ($past as $event)
                            <x-event-card
                                past
                                :title="$event['title']"
                                :type="$event['type']"
                                :modality="$event['modality']"
                                :date="$event['date']"
                                :place="$event['place']"
                                :href="route('events.show', $event['id'])"
                            />
                        @endforeach
                    </div>
                    @if ($past->hasPages())
                        <x-pagination :paginator="$past" />
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.site>
