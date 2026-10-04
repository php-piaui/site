{{--
    Banner "CFP aberto" com prazo e contagem regressiva (components/content/CfpBanner). Contagem calculada no servidor.
    Uso: <x-cfp-banner event-name="PHPeste 2025" deadline-label="15 de agosto" deadline="2025-08-15 23:59" submit-url="/cfp" rules-url="/cfp/regras" />
         <x-cfp-banner compact event-name="PHPeste 2025" deadline-label="15 de agosto" submit-url="/cfp" />
--}}
@props([
    'eventName' => '',
    'deadlineLabel' => '',
    'deadline' => null,
    'countdown' => true,
    'compact' => false,
    'title' => null,
    'text' => null,
    'ctaLabel' => 'Submeter proposta',
    'submitUrl' => null,
    'secondaryLabel' => 'Ler as regras',
    'rulesUrl' => null,
])

@php
    $remaining = $countdown && $deadline ? max(0, now()->diffInMinutes(\Illuminate\Support\Carbon::parse($deadline), false)) : null;
    $parts = $remaining === null ? null : [
        'd' => intdiv((int) $remaining, 1440),
        'h' => intdiv((int) $remaining, 60) % 24,
        'm' => (int) $remaining % 60,
    ];
@endphp

@if ($compact)
    <section {{ $attributes->class('pp-cfp pp-cfp--compact') }} aria-label="Call for papers aberto">
        <div>
            <span class="pp-cfp__eyebrow"><span class="pp-cfp__dot"></span>CFP aberto até {{ $deadlineLabel }}</span>
            <p class="pp-cfp__title">{{ $title ?? "Submeta sua palestra para o {$eventName}" }}</p>
        </div>
        <x-button variant="cta" icon="send" :href="$submitUrl">{{ $ctaLabel }}</x-button>
    </section>
@else
    <section {{ $attributes->class('pp-cfp') }} aria-label="Call for papers aberto">
        <x-logo variant="symbol" :size="180" tone="white" title="" class="pp-cfp__mark" />
        <div style="position: relative">
            <span class="pp-cfp__eyebrow"><span class="pp-cfp__dot"></span>Call for papers aberto · {{ $eventName }}</span>
            <h2 class="pp-cfp__title">{{ $title ?? 'Sua primeira palestra pode ser aqui.' }}</h2>
            <p class="pp-cfp__text">{{ $text ?? 'Palestra, lightning talk ou workshop. Não precisa ser especialista: conte o que você aprendeu resolvendo um problema real.' }}</p>
        </div>
        <div class="pp-cfp__side">
            @if ($parts)
                <ul class="pp-countdown" aria-label="Faltam {{ $parts['d'] }} dias, {{ $parts['h'] }} horas e {{ $parts['m'] }} minutos">
                    <li><b>{{ sprintf('%02d', $parts['d']) }}</b><span>dias</span></li>
                    <li><b>{{ sprintf('%02d', $parts['h']) }}</b><span>horas</span></li>
                    <li><b>{{ sprintf('%02d', $parts['m']) }}</b><span>min</span></li>
                </ul>
            @endif
            <p class="pp-cfp__deadline"><x-icon name="clock" :width="16" :height="16" />Envie até <strong>{{ $deadlineLabel }}</strong></p>
            <div style="display: flex; gap: 8px; flex-wrap: wrap">
                <x-button variant="cta" size="lg" icon="send" :href="$submitUrl">{{ $ctaLabel }}</x-button>
                @if ($rulesUrl)
                    <x-button variant="ghost" size="lg" :href="$rulesUrl" style="color: #fff">{{ $secondaryLabel }}</x-button>
                @endif
            </div>
        </div>
    </section>
@endif
