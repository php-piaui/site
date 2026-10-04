<x-layouts.admin title="Novo evento" current="novo">
    <form method="POST" enctype="multipart/form-data" class="pp-card grid max-w-[760px] gap-5 p-7">
        @csrf
        <h1 class="text-3xl">Novo evento</h1>
        <x-text-field name="title" label="Nome do evento" placeholder="Meetup #33 — …" required />
        <x-radio-group name="type" legend="Tipo" direction="row" value="meetup" :options="['meetup' => 'Meetup', 'evento' => 'Evento']" />
        <x-radio-group name="modality" legend="Modalidade" direction="row" value="presencial" :options="['presencial' => 'Presencial', 'online' => 'Online', 'hibrido' => 'Híbrido']" />
        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,200px),1fr))] gap-4.5">
            <x-text-field name="date" label="Data" type="date" required />
            <x-text-field name="starts_at" label="Início" type="time" required />
            <x-text-field name="ends_at" label="Fim" type="time" />
        </div>
        <x-text-field name="place" label="Local ou link da transmissão" icon="map-pin" required />
        <x-text-field name="register_url" label="Link de inscrição (site externo)" type="url" icon="external-link" hint="Sympla, Even3… O botão “Inscrever-se” vai abrir este link." required />
        <x-text-area name="description" label="Descrição" :rows="4" :max-length="800" />
        <div class="flex flex-wrap justify-end gap-2">
            <x-button variant="ghost" :href="route('admin.events')">Cancelar</x-button>
            <x-button variant="secondary" type="submit" name="draft" value="1">Salvar rascunho</x-button>
            <x-button variant="primary" type="submit">Publicar evento</x-button>
        </div>
    </form>
</x-layouts.admin>
