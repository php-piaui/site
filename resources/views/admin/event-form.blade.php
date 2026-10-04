<x-layouts.admin :title="$event ? 'Editar evento' : 'Novo evento'" :current="$event ? 'eventos' : 'novo'">
    <form method="POST" action="{{ $event ? route('admin.events.update', $event) : route('admin.events.store') }}" class="pp-card grid max-w-[760px] gap-5 p-7">
        @csrf
        @if ($event)
            @method('PUT')
        @endif
        <h1 class="text-3xl">{{ $event ? 'Editar evento' : 'Novo evento' }}</h1>
        <x-text-field name="title" label="Nome do evento" placeholder="Meetup #33 — …" :value="$event?->title" required />
        <x-radio-group name="type" legend="Tipo" direction="row" :value="$event?->type->value ?? 'meetup'" :options="['meetup' => 'Meetup', 'evento' => 'Evento']" />
        <x-radio-group name="modality" legend="Modalidade" direction="row" :value="$event?->modality->value ?? 'presencial'" :options="['presencial' => 'Presencial', 'online' => 'Online', 'hibrido' => 'Híbrido']" />
        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,200px),1fr))] gap-4.5">
            <x-text-field name="date" label="Data" type="date" :value="$event?->starts_at->format('Y-m-d')" required />
            <x-text-field name="starts_at" label="Início" type="time" :value="$event?->starts_at->format('H:i')" required />
            <x-text-field name="ends_at" label="Fim" type="time" :value="$event?->ends_at?->format('H:i')" />
        </div>
        <x-text-field name="place" label="Local ou link da transmissão" icon="map-pin" :value="$event?->place" required />
        <x-text-field name="register_url" label="Link de inscrição (site externo)" type="url" icon="external-link" :value="$event?->register_url" hint="Sympla, Even3… O botão “Inscrever-se” vai abrir este link." required />
        <x-text-area name="description" label="Descrição" :rows="4" :max-length="800" :value="$event?->description" />
        <div class="flex flex-wrap justify-end gap-2">
            <x-button variant="ghost" :href="route('admin.events')">Cancelar</x-button>
            <x-button variant="secondary" type="submit" name="draft" value="1">Salvar rascunho</x-button>
            <x-button variant="primary" type="submit">{{ $event?->published_at ? 'Salvar alterações' : 'Publicar evento' }}</x-button>
        </div>
    </form>
</x-layouts.admin>
