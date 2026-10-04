<x-layouts.site title="Call for papers" current="cfp">
    @if ($cfp)
    <div class="pp-container pb-18">
        <x-page-head
            :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Call for papers']]"
            :eyebrow="'Call for papers · '.$cfp->event->title"
            title="Sua primeira palestra pode ser aqui."
            lead="Não precisa ser especialista. Se você resolveu um problema com PHP e aprendeu alguma coisa no caminho, isso já é uma boa palestra."
        >
            <div class="mt-1 flex flex-wrap items-center gap-2">
                <x-button variant="cta" size="lg" icon="send" :href="\App\Support\SiteContent::submitUrl()">Submeter proposta</x-button>
                <span class="inline-flex items-center gap-1.5 text-[15px] text-fg-muted"><x-icon name="clock" :width="16" :height="16" />Prazo: <b class="text-fg">{{ $cfp->deadlineLabel() }}</b></span>
            </div>
        </x-page-head>
        <div class="flex flex-wrap items-start gap-10">
            <div class="grid min-w-0 flex-[999_1_560px] gap-12">
                <section>
                    <h2 class="mb-4 text-2xl">Formatos</h2>
                    <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,200px),1fr))] gap-3">
                        @foreach ($cfp->formats as $format)
                            <div class="pp-card grid content-start gap-2 p-5">
                                <div><x-badge :preset="$format->value" /></div>
                                <h3 class="text-[19px] leading-6">{{ $format->label() }}</h3>
                                <p class="font-mono text-sm font-medium text-brand">{{ $format->duration() }}</p>
                                <p class="text-[15px] text-fg-muted">{{ $format->pitch() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section class="pp-prose text-[17px]">
                    <h2 class="mt-0">Regras</h2>
                    <ul>
                        <li>Qualquer pessoa pode enviar, de qualquer lugar. Prioridade para quem é do Piauí e para quem nunca palestrou.</li>
                        <li>Até {{ \App\Models\Cfp::MAX_PROPOSALS_PER_SPEAKER }} propostas por pessoa. Pode ser em dupla.</li>
                        <li>Conteúdo técnico ou de carreira ligado a PHP. Nada de pitch de produto.</li>
                        <li>Todas as pessoas palestrantes seguem o <a href="{{ route('conduct') }}">código de conduta</a>.</li>
                    </ul>
                    <h2>Como avaliamos</h2>
                    <p>Um comitê de voluntários lê cada proposta sem olhar nome ou empresa na primeira rodada. Olhamos clareza, utilidade para a plateia e variedade da grade.</p>
                    @if ($cfp->rules)
                        <h2>Observações</h2>
                        <p class="whitespace-pre-line">{{ $cfp->rules }}</p>
                    @endif
                    <h2>Datas</h2>
                    <ul>
                        <li><b>{{ $cfp->closes_at->translatedFormat('j \\d\\e F') }}</b> — fim do envio</li>
                        <li><b>{{ $cfp->event->starts_at->translatedFormat('j \\d\\e F') }}</b> — evento</li>
                    </ul>
                </section>
            </div>
            <aside class="pp-card sticky top-22 grid flex-[1_1_300px] gap-3.5 p-6">
                <div><x-badge preset="cfp-open" /></div>
                <h2 class="text-[22px] leading-7">Envie até {{ $cfp->deadlineLabel() }}</h2>
                <p class="text-[15px] text-fg-muted">Leva uns 10 minutos. Você pode editar enquanto a proposta estiver em revisão.</p>
                <x-button variant="cta" size="lg" block icon="send" :href="\App\Support\SiteContent::submitUrl()">Submeter proposta</x-button>
            </aside>
        </div>
    </div>

    @else
        <div class="pp-container pb-18">
            <x-page-head title="Call for papers" :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Call for papers']]" />
            <x-empty-state icon="megaphone" title="Nenhum CFP aberto agora">
                Quando abrir a chamada do próximo evento, ela aparece aqui e no Instagram @php.piaui.
                <x-slot:actions><x-button variant="secondary" :href="route('events.index')">Ver eventos</x-button></x-slot:actions>
            </x-empty-state>
        </div>
    @endif

    @if ($cfp && $explainAccount)
        {{-- Explicação pré-login (ADR 0001 §2.3): por que a conta é necessária, antes de qualquer redirecionamento. --}}
        <div class="pp-overlay">
            <div class="pp-dialog pp-dialog--wide relative" role="dialog" aria-modal="true" aria-labelledby="pre-login-title">
                <span class="absolute top-3 right-3"><x-button variant="ghost" icon-only icon="x" label="Fechar" :href="route('cfp.show')" /></span>
                <span class="pp-dialog__icon"><x-logo variant="symbol" :size="20" tone="currentColor" title="" /></span>
                <div class="grid gap-1.5">
                    <h2 class="pp-dialog__title" id="pre-login-title">Para enviar sua proposta, você vai precisar de uma conta</h2>
                    <p class="pp-dialog__body">É rápido: só e-mail e senha. Com ela você pode:</p>
                </div>
                <ul class="grid gap-3.5">
                    @foreach ([
                        ['hourglass', 'Acompanhar o status', 'Veja se está em revisão, aprovada ou recusada, sem precisar perguntar.'],
                        ['pencil', 'Editar enquanto está em revisão', 'Lembrou de algo? Ajuste título e resumo até o fim do prazo.'],
                        ['mail', 'Receber a resposta por e-mail', 'Todo mundo recebe resposta, aprovada ou não.'],
                        ['user-round', 'Reaproveitar seu perfil', 'Bio, foto e redes ficam salvas para os próximos CFPs.'],
                    ] as [$icon, $title, $text])
                        <li class="grid grid-cols-[36px_1fr] items-start gap-3">
                            <span class="grid size-9 place-items-center rounded-[10px] bg-brand-soft text-brand"><x-icon :name="$icon" :width="18" :height="18" /></span>
                            <span><b class="block text-[15px]">{{ $title }}</b><span class="text-sm text-fg-muted">{{ $text }}</span></span>
                        </li>
                    @endforeach
                </ul>
                <div class="pp-dialog__actions">
                    <x-button variant="secondary" icon="log-in" :href="route('login', ['cfp' => 1])">Já tenho conta — Entrar</x-button>
                    <x-button variant="cta" :href="route('register', ['cfp' => 1])" autofocus>Criar conta</x-button>
                </div>
            </div>
            <script>document.addEventListener('keydown', event => event.key === 'Escape' && location.assign(@js(route('cfp.show'))));</script>
        </div>
    @endif
</x-layouts.site>
