{{--
    Select nativo no estilo dos inputs (components/forms/Select). options: ['valor' => 'Rótulo'] ou lista de strings.
    value cai para old($name); error cai para $errors->first($name).
    Uso: <x-select name="formato" label="Formato" placeholder="Escolha…" :options="['palestra' => 'Palestra', 'workshop' => 'Workshop']" required />
--}}
@props([
    'name',
    'id' => null,
    'label' => null,
    'options' => [],
    'value' => null,
    'placeholder' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
    'optional' => false,
])

@php
    $id ??= $name;
    $value = (string) old($name, $value);
    $error ??= isset($errors) ? $errors->first($name) : null;
    $options = array_is_list($options) ? array_combine($options, $options) : $options;
    $describedBy = collect([$hint ? "{$id}-hint" : null, $error ? "{$id}-error" : null])->filter()->implode(' ');
@endphp

<x-field :id="$id" :label="$label" :required="$required" :optional="$optional" :hint="$hint" :error="$error">
    <div class="pp-select">
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            @required($required)
            @if ($error) aria-invalid="true" @endif
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            {{ $attributes->class('pp-input') }}
        >
            @if ($placeholder)
                <option value="" disabled @selected($value === '')>{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected($value === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
        <x-icon name="chevron-down" :width="18" :height="18" class="pp-select__chev" />
    </div>
</x-field>
