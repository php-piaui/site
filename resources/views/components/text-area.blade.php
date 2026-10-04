{{--
    Campo multilinha (components/forms/TextArea) com contador de caracteres ao vivo quando há max-length.
    value cai para old($name); error cai para $errors->first($name). Demais atributos vão para o <textarea>.
    Uso: <x-text-area name="resumo" label="Resumo" hint="Conte o que o público vai aprender." :max-length="600" required />
--}}
@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
    'optional' => false,
    'maxLength' => null,
    'rows' => 5,
])

@php
    $id ??= $name;
    $value = (string) old($name, $value);
    $error ??= isset($errors) ? $errors->first($name) : null;
    $isOver = $maxLength !== null && mb_strlen($value) > $maxLength;
    $describedBy = collect([$hint ? "{$id}-hint" : null, $error ? "{$id}-error" : null])->filter()->implode(' ');
@endphp

<x-field :id="$id" :label="$label" :required="$required" :optional="$optional" :hint="$hint" :error="$error" :count="mb_strlen($value)" :max-length="$maxLength">
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @required($required)
        @if ($error || $isOver) aria-invalid="true" @endif
        @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
        @if ($maxLength !== null) oninput="const c = this.closest('.pp-field').querySelector('.pp-counter'); c.textContent = this.value.length + '/{{ $maxLength }}'; c.classList.toggle('pp-counter--over', this.value.length > {{ $maxLength }})" @endif
        {{ $attributes->class('pp-input') }}
    >{{ $value }}</textarea>
</x-field>
