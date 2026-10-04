{{--
    Lista de propostas do admin (components/admin/ProposalTable). Tabela ≥768px, cards empilhados abaixo.
    Aprovar/Recusar só enquanto status = review.
    Cada proposta: id, title, speaker, format (palestra|lightning|workshop), sent_at ("02/10/2026"),
    status (review|approved|rejected), url (Ver), approve_url e reject_url (POST).
    layout: auto · table · cards
    Uso: <x-proposal-table :proposals="$proposals" />
--}}
@props([
    'proposals' => [],
    'layout' => 'auto',
])

<div {{ $attributes->class(['pp-table-wrap', 'pp-table-wrap--auto' => $layout === 'auto']) }}>
    @if ($layout !== 'cards')
        <table class="pp-table">
            <thead>
                <tr>
                    <th>Proposta</th>
                    <th>Formato</th>
                    <th>Enviada em</th>
                    <th>Status</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <x-avatar :name="$proposal['speaker']" :size="36" />
                                <div>
                                    <div class="pp-table__title">{{ $proposal['title'] }}</div>
                                    <div class="pp-table__sub">{{ $proposal['speaker'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><x-badge :preset="$proposal['format']" size="sm" /></td>
                        <td class="pp-table__muted">{{ $proposal['sent_at'] }}</td>
                        <td><x-badge :preset="$proposal['status']" size="sm" /></td>
                        <td>
                            <div class="pp-table__actions">
                                @include('components.proposal-table.actions', ['proposal' => $proposal, 'size' => 'sm'])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($layout !== 'table')
        <ul class="pp-rows">
            @foreach ($proposals as $proposal)
                <li class="pp-card pp-row-card">
                    <div class="flex flex-wrap gap-2">
                        <x-badge :preset="$proposal['status']" size="sm" />
                        <x-badge :preset="$proposal['format']" size="sm" />
                    </div>
                    <div>
                        <div class="pp-table__title">{{ $proposal['title'] }}</div>
                        <div class="pp-table__sub">{{ $proposal['speaker'] }} · {{ $proposal['sent_at'] }}</div>
                    </div>
                    <div @class(['pp-row-card__actions', 'grid-cols-1' => $proposal['status'] !== 'review'])>
                        @include('components.proposal-table.actions', ['proposal' => $proposal, 'size' => 'md'])
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
