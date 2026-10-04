{{--
    Confirmação transitória (components/feedback/Toast). Coloque dentro de <x-toast.region>. tone: info · success · warning · danger
    duration em ms some sozinho (0 = fixo).
    Uso: <x-toast.region>@if (session('status'))<x-toast :title="session('status')" />@endif</x-toast.region>
--}}
@props([
    'tone' => 'success',
    'title',
    'duration' => 5000,
    'dismissible' => true,
])

@php
    $icons = ['info' => 'info', 'success' => 'circle-check', 'warning' => 'triangle-alert', 'danger' => 'circle-alert'];
@endphp

<div role="{{ $tone === 'danger' ? 'alert' : 'status' }}" {{ $attributes->class('pp-toast') }}>
    <x-icon :name="$icons[$tone]" class="pp-toast__icon--{{ $tone }}" style="margin-top: 1px" />
    <div>
        <p class="pp-toast__title">{{ $title }}</p>
        @if ($slot->isNotEmpty())
            <p class="pp-toast__body">{{ $slot }}</p>
        @endif
    </div>
    @if ($dismissible)
        <span style="margin: -10px"><x-button variant="ghost" size="sm" icon-only icon="x" label="Fechar" onclick="this.closest('.pp-toast').remove()" /></span>
    @else
        <span></span>
    @endif
    @if ($duration)
        <script>(toast => setTimeout(() => toast.remove(), {{ (int) $duration }}))(document.currentScript.parentElement);</script>
    @endif
</div>
