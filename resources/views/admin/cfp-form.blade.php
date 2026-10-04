<x-layouts.admin title="Abrir CFP" current="cfp">
    @if ($events === [])
        <x-empty-state icon="calendar" title="Nenhum evento sem CFP">
            Todo evento futuro já tem chamada aberta. Cadastre um evento novo primeiro.
            <x-slot:actions><x-button variant="primary" icon="plus" :href="route('admin.events.create')">Novo evento</x-button></x-slot:actions>
        </x-empty-state>
    @else
    <form method="POST" action="{{ route('admin.cfp.store') }}" class="pp-card grid max-w-[760px] gap-5 p-7">
        @csrf
        <h1 class="text-3xl">Abrir call for papers</h1>
        <x-select name="event_id" label="Evento" :options="$events" :value="$selected" />
        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,240px),1fr))] gap-4.5">
            <x-text-field name="opens_at" label="Abre em" type="datetime-local" required />
            <x-text-field name="closes_at" label="Encerra em" type="datetime-local" hint="Horário de Teresina (UTC−3)." required />
        </div>
        <fieldset class="pp-fieldset" @error('formats') aria-invalid="true" @enderror>
            <legend class="pp-label">Formatos aceitos</legend>
            @foreach (\App\Enums\ProposalFormat::cases() as $format)
                <x-checkbox name="formats[]" :id="'format-'.$format->value" :value="$format->value" :label="$format->label().' ('.$format->duration().')'" :checked="in_array($format->value, old('formats', ['palestra', 'lightning']), true)" />
            @endforeach
            @error('formats')
                <p class="pp-error" role="alert">{{ $message }}</p>
            @enderror
        </fieldset>
        <x-text-area name="rules" label="Regras e observações" :rows="4" hint="Aparece na página pública do CFP." />
        <x-checkbox name="show_countdown" label="Mostrar contagem regressiva no banner" checked />
        <div class="flex justify-end gap-2">
            <x-button variant="ghost" :href="route('admin.events')">Cancelar</x-button>
            <x-button variant="primary" type="submit" icon="megaphone">Abrir CFP</x-button>
        </div>
    </form>
    @endif
</x-layouts.admin>
