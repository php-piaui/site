{{-- Região fixa de toasts: centro-inferior no mobile, canto inferior direito no desktop. Uso: <x-toast.region><x-toast title="Salvo" /></x-toast.region> --}}
<div aria-live="polite" {{ $attributes->class('pp-toast-region') }}>{{ $slot }}</div>
