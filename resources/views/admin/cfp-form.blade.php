<x-layouts.admin title="Abrir CFP" current="cfp">
    <form method="POST" class="pp-card grid max-w-[760px] gap-5 p-7">
        @csrf
        <h1 class="text-3xl">Abrir call for papers</h1>
        <x-select name="event" label="Evento" :options="$events" />
        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,240px),1fr))] gap-4.5">
            <x-text-field name="opens_at" label="Abre em" type="datetime-local" required />
            <x-text-field name="closes_at" label="Encerra em" type="datetime-local" hint="Horário de Teresina (UTC−3)." required />
        </div>
        <fieldset class="pp-fieldset">
            <legend class="pp-label">Formatos aceitos</legend>
            <x-checkbox name="formats[]" id="format-palestra" value="palestra" label="Palestra (30–40 min)" checked />
            <x-checkbox name="formats[]" id="format-lightning" value="lightning" label="Lightning talk (5–10 min)" checked />
            <x-checkbox name="formats[]" id="format-workshop" value="workshop" label="Workshop (2 h)" />
        </fieldset>
        <x-text-area name="rules" label="Regras e observações" :rows="4" hint="Aparece na página pública do CFP." />
        <x-checkbox name="countdown" label="Mostrar contagem regressiva no banner" checked />
        <div class="flex justify-end gap-2">
            <x-button variant="ghost" :href="route('admin.events')">Cancelar</x-button>
            <x-button variant="primary" type="submit" icon="megaphone">Abrir CFP</x-button>
        </div>
    </form>
</x-layouts.admin>
