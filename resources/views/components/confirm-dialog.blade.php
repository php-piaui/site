{{--
    Confirmação modal (components/feedback/ConfirmDialog): aprovar / recusar / excluir. Bottom sheet no mobile.
    Renderize só quando o diálogo deve aparecer; confirmar envia o form para action, cancelar volta para cancel-href.
    tone: brand · success · danger (danger usa botão danger)
    Uso: <x-confirm-dialog tone="danger" title="Excluir proposta?" :action="route('proposals.destroy', $p)" method="DELETE" :cancel-href="url()->previous()" confirm-label="Excluir">Essa ação não pode ser desfeita.</x-confirm-dialog>
--}}
@props([
    'tone' => 'brand',
    'icon' => null,
    'title',
    'action',
    'method' => 'POST',
    'cancelHref',
    'confirmLabel' => 'Confirmar',
    'cancelLabel' => 'Cancelar',
    'inline' => false,
])

@php
    $icon ??= ['danger' => 'circle-x', 'success' => 'circle-check'][$tone] ?? 'info';
    $titleId = 'pp-dlg-'.str()->random(6);
@endphp

<div {{ $attributes->class(['pp-overlay', 'pp-overlay--inline' => $inline]) }}>
    <form method="POST" action="{{ $action }}" class="pp-dialog" role="dialog" aria-modal="true" aria-labelledby="{{ $titleId }}">
        @csrf
        @method($method)
        <span @class(['pp-dialog__icon', "pp-dialog__icon--{$tone}" => $tone !== 'brand'])><x-icon :name="$icon" :width="22" :height="22" /></span>
        <h2 class="pp-dialog__title" id="{{ $titleId }}">{{ $title }}</h2>
        <div class="pp-dialog__body">{{ $slot }}</div>
        <div class="pp-dialog__actions">
            <x-button variant="secondary" :href="$cancelHref">{{ $cancelLabel }}</x-button>
            <x-button :variant="$tone === 'danger' ? 'danger' : 'primary'" type="submit" autofocus>{{ $confirmLabel }}</x-button>
        </div>
    </form>
</div>
