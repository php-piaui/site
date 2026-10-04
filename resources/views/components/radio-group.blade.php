{{--
    Grupo de radios em fieldset (components/forms/RadioGroup). direction: column · row
    options: ['valor' => 'Rótulo'] ou [['value' => 'online', 'label' => 'Online', 'description' => '…', 'disabled' => true]]
    value cai para old($name); error cai para $errors->first($name).
    Uso: <x-radio-group name="modalidade" legend="Modalidade" direction="row" :options="['presencial' => 'Presencial', 'online' => 'Online']" />
--}}
@props([
    'name',
    'legend' => null,
    'options' => [],
    'value' => null,
    'error' => null,
    'direction' => 'column',
])

@php
    $value = (string) old($name, $value);
    $error ??= isset($errors) ? $errors->first($name) : null;
    $options = collect($options)->map(fn (array|string $option, int|string $key): array => is_array($option) ? $option : ['value' => $key, 'label' => $option]);
@endphp

<fieldset @if ($error) aria-invalid="true" @endif {{ $attributes->class('pp-fieldset') }}>
    @if ($legend)
        <legend class="pp-label">{{ $legend }}</legend>
    @endif
    <div style="display: flex; flex-direction: {{ $direction }}; gap: {{ $direction === 'row' ? 24 : 0 }}px; flex-wrap: wrap">
        @foreach ($options as $option)
            <label @class(['pp-check pp-check--radio', 'pp-check--disabled' => $option['disabled'] ?? false])>
                <span class="pp-check__box">
                    <input
                        type="radio"
                        name="{{ $name }}"
                        value="{{ $option['value'] }}"
                        @checked($value === (string) $option['value'])
                        @disabled($option['disabled'] ?? false)
                        @if ($error) aria-invalid="true" @endif
                    >
                    <span class="pp-check__mark"></span>
                </span>
                <span>{{ $option['label'] }}@if ($option['description'] ?? null)<span class="pp-check__desc">{{ $option['description'] }}</span>@endif</span>
            </label>
        @endforeach
    </div>
    @if ($error)
        <p class="pp-error" role="alert">{{ $error }}</p>
    @endif
</fieldset>
