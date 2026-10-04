{{--
    Checkbox com linha de toque de 44px (components/forms/Checkbox), descrição e erro opcionais.
    checked cai para old($name); error cai para $errors->first($name).
    Uso: <x-checkbox name="aceite" label="Li e aceito o código de conduta" description="Obrigatório para submeter." />
--}}
@props([
    'name',
    'id' => null,
    'label',
    'description' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
    'error' => null,
])

@php
    $id ??= $name;
    $error ??= isset($errors) ? $errors->first($name) : null;
@endphp

<div>
    <label @class(['pp-check', 'pp-check--disabled' => $disabled]) for="{{ $id }}">
        <span class="pp-check__box">
            <input
                type="checkbox"
                id="{{ $id }}"
                name="{{ $name }}"
                value="{{ $value }}"
                @checked(old($name, $checked))
                @disabled($disabled)
                @if ($error) aria-invalid="true" aria-describedby="{{ $id }}-error" @endif
                {{ $attributes }}
            >
            <span class="pp-check__mark"><x-icon name="check" :width="16" :height="16" stroke-width="3" /></span>
        </span>
        <span>{{ $label }}@if ($description)<span class="pp-check__desc">{{ $description }}</span>@endif</span>
    </label>
    @if ($error)
        <p class="pp-error" id="{{ $id }}-error" role="alert"><x-icon name="circle-alert" :width="16" :height="16" />{{ $error }}</p>
    @endif
</div>
