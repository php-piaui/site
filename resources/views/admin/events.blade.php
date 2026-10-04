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
                        <td><div class="pp-table__title">{{ $event['title'] }}</div><div class="pp-table__sub">{{ $event['place'] }}</div></td>
                        <td class="pp-table__muted">{{ $event['date'] }}</td>
                        <td><x-badge :preset="$event['modality']" size="sm" /></td>
                        <td>
                            @if ($event['cfp_open'] ?? false)
                                <x-badge preset="cfp-open" size="sm" />
                            @else
                                <span class="pp-table__muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="pp-table__actions">
                                <x-button variant="ghost" size="sm" icon="pencil" href="#">Editar</x-button>
                                @if (isset($event['register_url']) && ! ($event['cfp_open'] ?? false))
                                    <x-button variant="secondary" size="sm" icon="megaphone" :href="route('admin.cfp.create')">Abrir CFP</x-button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
