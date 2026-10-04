{{-- Ações de uma linha da x-proposal-table. Aprovar/Recusar levam à confirmação (approve_url/reject_url); nos cards, os botões ocupam a célula inteira do grid. --}}
@if ($proposal['status'] === 'review')
    <x-button variant="primary" :size="$size" :block="$size === 'md'" icon="check" :href="$proposal['approve_url']">Aprovar</x-button>
    <x-button variant="secondary" :size="$size" :block="$size === 'md'" icon="x" :href="$proposal['reject_url']">Recusar</x-button>
@else
    <x-button variant="ghost" :size="$size" :block="$size === 'md'" icon="eye" :href="$proposal['url']">Ver</x-button>
@endif
