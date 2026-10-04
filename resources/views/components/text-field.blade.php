{{--
    Campo de uma linha (components/forms/TextField) com label, dica, erro e contador opcional.
    value cai para old($name); error cai para $errors->first($name). Demais atributos (placeholder, autocomplete, disabled…) vão para o <input>.
    Uso: <x-text-field name="email" type="email" label="E-mail" icon="mail" required autocomplete="email" />
         <x-text-field name="titulo" label="Título" :max-length="80" show-count />
--}}
@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
    'optional' => false,
    'maxLength' => null,
    'showCount' => false,
    'icon' => null,
])

@php
    $id ??= $name;
    $value = old($name, $value);
    $error ??= isset($errors) ? $errors->first($name) : null;
    $counterMax = $showCount ? $maxLength : null;
    $describedBy = collect([$hint ? "{$id}-hint" : null, $error ? "{$id}-error" : null])->filter()->implode(' ');
@endphp

<x-field :id="$id" :label="$label" :required="$required" :optional="$optional" :hint="$hint" :error="$error" :count="mb_strlen((string) $value)" :max-length="$counterMax">
    @if ($icon)
        <div class="pp-input-wrap">
            <x-icon :name="$icon" :width="18" :height="18" class="pp-input-wrap__icon" />
    @endif
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $value }}"
        @required($required)
        @if ($error) aria-invalid="true" @endif
        @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
        @if ($counterMax !== null) oninput="const c = this.closest('.pp-field').querySelector('.pp-counter'); c.textContent = this.value.length + '/{{ $counterMax }}'; c.classList.toggle('pp-counter--over', this.value.length > {{ $counterMax }})" @endif
        {{ $attributes->class('pp-input') }}
    >
    @if ($icon)
        </div>
    @endif
</x-field>
