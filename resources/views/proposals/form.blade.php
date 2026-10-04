{{--
    Nova proposta, edição (em revisão) e leitura (aprovada/recusada) — SubmitScreen em ui_kits/site/SpeakerScreens.jsx.
    ADR 0001 §2.3: depois da decisão a proposta fica somente leitura.
--}}
@php
    $decided = (bool) $proposal?->isDecided();
    $heading = $decided ? $proposal->title : ($proposal ? 'Editar proposta' : 'Nova proposta');
    $errorCount = count($errors->keys());
@endphp

<x-layouts.site :title="$heading" current="minhas">
    <div class="pp-container max-w-[760px] pb-18">
        <x-page-head
            :title="$heading"
            :lead="$decided ? null : 'CFP do '.$cfp->event->title.' · envio até '.$cfp->deadlineLabel()"
            :crumbs="[['label' => 'Minhas propostas', 'href' => route('proposals.index')], ['label' => $decided ? 'Proposta' : $heading]]"
        >
            @if ($decided)
                <div class="flex flex-wrap gap-2">
                    <x-badge :preset="$proposal->status->value" />
                    <x-badge :preset="$proposal->format->value" />
                </div>
            @endif
        </x-page-head>
        <div class="grid gap-6">
            @if ($decided)
                <div class="pp-readonly">
                    <x-icon name="lock" :width="18" :height="18" />
                    <span><b class="text-fg">Somente leitura.</b> Esta proposta foi {{ mb_strtolower($proposal->status->label()) }} em {{ $proposal->decided_at->format('d/m/Y') }} e não pode mais ser editada.</span>
                </div>
            @else
                <x-alert>Você pode editar a proposta enquanto ela estiver <b>em revisão</b>. Depois da decisão, ela fica somente leitura.</x-alert>
            @endif
            @if ($errorCount)
                <x-alert tone="danger" :title="$errorCount > 1 ? 'Faltam '.$errorCount.' campos' : 'Falta 1 campo'">Revise os campos destacados abaixo.</x-alert>
            @endif
            <form method="POST" action="{{ $proposal ? route('proposals.update', $proposal) : route('proposals.store') }}" class="pp-card grid gap-5.5 p-7">
                @csrf
                @if ($proposal)
                    @method('PUT')
                @endif
                <x-text-field name="title" label="Título" :max-length="90" show-count :value="$proposal?->title" :readonly="$decided" :hint="$decided ? null : 'Curto e concreto. Ex.: “Filas no Laravel sem dor de cabeça”.'" />
                <x-radio-group name="format" legend="Formato" :value="$proposal?->format->value ?? $cfp->formats->first()?->value" :options="$cfp->formats->map(fn ($format) => ['value' => $format->value, 'label' => $format->label(), 'description' => $format->duration(), 'disabled' => $decided])->all()" />
                <x-select name="level" label="Para quem é?" :value="$proposal?->level ?? 'Iniciante'" :options="\App\Models\Proposal::LEVELS" :disabled="$decided" />
                <x-text-area name="summary" label="Resumo para o público" :max-length="600" :rows="5" :value="$proposal?->summary" :readonly="$decided" :hint="$decided ? null : 'Aparece no site se a proposta for aprovada.'" />
                <x-text-area name="notes" label="Notas para o comitê" optional :rows="3" :max-length="1000" :value="$proposal?->notes" :readonly="$decided" :hint="$decided ? null : 'Contexto, links, se já apresentou antes. Só o comitê lê.'" />
                @unless ($decided)
                    <x-radio-group name="first_talk" legend="É sua primeira palestra?" direction="row" :value="(int) ($proposal?->first_talk ?? false)" :options="['1' => 'Sim, primeira vez', '0' => 'Não']" />
                @endunless
                <div class="flex items-center gap-3.5 rounded-md bg-sunken p-4">
                    <x-avatar :name="$user->name" :src="$user->photoUrl()" :size="44" />
                    <div class="min-w-0 flex-1">
                        <b class="text-[15px]">{{ $user->name }}</b>
                        <div class="text-sm text-fg-muted">Dados de palestrante vêm do seu perfil.</div>
                    </div>
                    <x-button variant="ghost" size="sm" icon="pencil" :href="route('profile.edit')">Editar perfil</x-button>
                </div>
                @unless ($decided)
                    <x-checkbox name="conduct" label="Li e concordo com o código de conduta." :checked="(bool) $proposal" />
                    <div class="flex flex-wrap justify-end gap-2">
                        <x-button variant="ghost" :href="route('proposals.index')">Cancelar</x-button>
                        <x-button variant="cta" size="lg" type="submit" icon="send">{{ $proposal ? 'Salvar alterações' : 'Enviar proposta' }}</x-button>
                    </div>
                @endunless
            </form>
        </div>
    </div>
</x-layouts.site>
