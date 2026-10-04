{{-- Ações de uma linha da x-proposal-table. Nos cards, os botões ocupam a célula inteira do grid. --}}
@if ($proposal['status'] === 'review')
    <form method="POST" action="{{ $proposal['approve_url'] }}">
        @csrf
        <x-button type="submit" variant="primary" :size="$size" :block="$size === 'md'" icon="check">Aprovar</x-button>
    </form>
    <form method="POST" action="{{ $proposal['reject_url'] }}">
        @csrf
        <x-button type="submit" variant="secondary" :size="$size" :block="$size === 'md'" icon="x">Recusar</x-button>
    </form>
@else
    <x-button variant="ghost" :size="$size" :block="$size === 'md'" icon="eye" :href="$proposal['url']">Ver</x-button>
@endif
