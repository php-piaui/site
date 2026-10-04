{{--
    Moldura compartilhada dos controles de formulário (components/forms/Field): label, dica, erro e contador.
    Usado por <x-text-field>, <x-text-area> e <x-select>; os ids de dica/erro seguem "{id}-hint" e "{id}-error".
--}}
@props([
    'id',
    'label' => null,
    'required' => false,
    'optional' => false,
    'hint' => null,
    'error' => null,
    'count' => 0,
    'maxLength' => null,
])

<div {{ $attributes->class('pp-field') }}>
    @if ($label)
        <label class="pp-label" for="{{ $id }}">{{ $label }}@if ($required)<span class="pp-label__req" aria-hidden="true"> *</span>@endif @if ($optional)<span class="pp-label__opt"> (opcional)</span>@endif</label>
    @endif
    @if ($hint)
        <p class="pp-hint" id="{{ $id }}-hint">{{ $hint }}</p>
    @endif
    {{ $slot }}
    @if ($error || $maxLength !== null)
        <div class="pp-field__foot">
            @if ($error)
                <p class="pp-error" id="{{ $id }}-error" role="alert"><x-icon name="circle-alert" :width="16" :height="16" />{{ $error }}</p>
            @else
                <span></span>
            @endif
            @if ($maxLength !== null)
                <span @class(['pp-counter', 'pp-counter--over' => $count > $maxLength]) aria-live="polite">{{ $count }}/{{ $maxLength }}</span>
            @endif
        </div>
    @endif
</div>
