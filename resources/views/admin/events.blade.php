<x-layouts.admin title="Eventos" current="eventos">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-3xl">Eventos</h1>
        <x-button variant="primary" icon="plus" :href="route('admin.events.create')">Novo evento</x-button>
    </div>
    <div class="pp-table-wrap">
        <table class="pp-table">
            <thead>
                <tr><th>Evento</th><th>Data</th><th>Modalidade</th><th>CFP</th><th class="text-right">Ações</th></tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td><div class="pp-table__title">{{ $event->title }}@unless ($event->published_at) <x-badge size="sm">Rascunho</x-badge>@endunless</div><div class="pp-table__sub">{{ $event->place }}</div></td>
                        <td class="pp-table__muted">{{ $event->starts_at->format('d/m/Y') }}</td>
                        <td><x-badge :preset="$event->modality->value" size="sm" /></td>
                        <td>
                            @if ($event->cfp?->isOpen())
                                <x-badge preset="cfp-open" size="sm" />
                            @else
                                <span class="pp-table__muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="pp-table__actions">
                                <x-button variant="ghost" size="sm" icon="pencil" :href="route('admin.events.edit', $event)">Editar</x-button>
                                @if (! $event->cfp && ! $event->isPast())
                                    <x-button variant="secondary" size="sm" icon="megaphone" :href="route('admin.cfp.create', ['evento' => $event->id])">Abrir CFP</x-button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
