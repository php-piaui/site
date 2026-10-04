<x-layouts.site>
    <section class="pp-container grid grid-cols-[repeat(auto-fit,minmax(min(100%,340px),1fr))] items-center gap-8 pt-12 pb-14">
        <div class="grid gap-5">
            <span class="pp-eyebrow">Comunidade PHP do Piauí · desde 2016</span>
            <h1 class="text-[clamp(38px,6vw,60px)] leading-[1.04] tracking-[-0.03em]">Gente que escreve PHP, se encontrando no Piauí.</h1>
            <p class="max-w-[50ch] text-lg text-fg-muted">Encontros abertos e gratuitos, feitos por voluntários. Para quem está começando, para quem mantém sistema legado e para quem quer palestrar pela primeira vez.</p>
            <div class="flex flex-wrap gap-2">
                <x-button variant="primary" size="lg" :href="route('events.index')" icon-right="arrow-right">Próximos eventos</x-button>
                <x-button variant="secondary" size="lg" icon="instagram" href="https://www.instagram.com/php.piaui/" external>Seguir no Instagram</x-button>
            </div>
        </div>
        <div class="relative grid aspect-[5/4] place-items-center overflow-hidden rounded-xl bg-indigo-300">
            <x-logo variant="symbol" :size="220" tone="var(--indigo-700)" title="" class="h-auto max-w-[72%]" />
            <span class="absolute bottom-4 left-5 font-mono text-[13px] leading-[18px] font-medium text-indigo-900">&lt;?php echo "Oxente, PHP!";</span>
        </div>
    </section>

    <section class="pp-container pb-14">
        <x-section-head title="Próximo evento">
            <x-slot:action><x-button variant="ghost" :href="route('events.index')" icon-right="arrow-right">Todos os eventos</x-button></x-slot:action>
        </x-section-head>
        @if ($event)
            @include('events.card', ['event' => $event, 'featured' => true])
        @else
            <x-empty-state title="Nenhum evento marcado por enquanto">
                Estamos organizando o próximo. A data sai primeiro no Instagram @php.piaui.
                <x-slot:actions><x-button variant="secondary" icon="instagram" href="https://www.instagram.com/php.piaui/" external>Seguir no Instagram</x-button></x-slot:actions>
            </x-empty-state>
        @endif
    </section>

    @if ($cfp)
        <section class="pp-container pb-16">
            <x-cfp-banner
                :event-name="$cfp->event->title"
                :deadline-label="$cfp->deadlineLabel()"
                :deadline="$cfp->closes_at"
                :countdown="$cfp->show_countdown"
                :submit-url="\App\Support\SiteContent::submitUrl()"
                :rules-url="route('cfp.show')"
            />
        </section>
    @endif

    <section class="border-y border-line bg-card">
        <div class="pp-container py-14">
            <x-section-head title="Como participar" />
            <ol class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,260px),1fr))] gap-8">
                @foreach ([
                    ['Venha a um encontro', 'Meetups mensais em Teresina e online. Não precisa saber tudo de PHP — só ter curiosidade.', 'Ver eventos', route('events.index')],
                    ['Suba no palco', 'Lightning talk de 5 minutos conta. A gente revisa sua proposta e ajuda a ensaiar se você quiser.', 'Conhecer o CFP', route('cfp.show')],
                    ['Ajude a fazer acontecer', 'Espaço, café, transmissão, divulgação. Empresas e pessoas apoiam do jeito que dá.', 'Quero apoiar', route('supporters')],
                ] as [$title, $text, $cta, $href])
                    <li class="grid content-start gap-2.5">
                        <span class="font-mono text-sm leading-none font-bold text-caju-700 dark:text-caju-300">0{{ $loop->iteration }}</span>
                        <h3 class="text-[22px] leading-7">{{ $title }}</h3>
                        <p class="text-fg-muted">{{ $text }}</p>
                        <div><x-button variant="link" :href="$href">{{ $cta }}</x-button></div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="pp-container pt-14 pb-18">
        <x-section-head title="Quem apoia" lead="Todo apoio tem o mesmo destaque. É isso que mantém os encontros gratuitos.">
            <x-slot:action><x-button variant="secondary" icon="heart" :href="route('supporters')">Quero apoiar</x-button></x-slot:action>
        </x-section-head>
        <x-supporter-grid :supporters="$supporters" />
    </section>
</x-layouts.site>
