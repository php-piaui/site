{{--
    Foto de palestrante (components/forms/PhotoUpload): prévia redonda + área de envio com input de arquivo real (acessível por teclado).
    A prévia é atualizada no navegador ao escolher ou arrastar uma imagem. error cai para $errors->first($name).
    Uso: <x-photo-upload name="foto" :src="$speaker->photo_url" initials="AS" />
--}}
@props([
    'name' => 'foto',
    'id' => null,
    'label' => 'Foto de perfil',
    'src' => null,
    'initials' => null,
    'hint' => 'JPG ou PNG, quadrada, até 2 MB.',
    'error' => null,
    'loading' => false,
])

@php
    $id ??= $name;
    $error ??= isset($errors) ? $errors->first($name) : null;
@endphp

<div {{ $attributes->class('pp-field') }}>
    <span class="pp-label" id="{{ $id }}-label">{{ $label }}</span>
    <div class="pp-photo">
        <div class="pp-photo__preview" aria-hidden="true">
            @if ($loading)
                <x-icon name="loader-circle" :width="28" :height="28" class="pp-spin" />
            @elseif ($src)
                <img src="{{ $src }}" alt="">
            @elseif ($initials)
                <span style="font: 700 28px/1 var(--font-display)">{{ $initials }}</span>
            @else
                <x-icon name="user-round" :width="36" :height="36" />
            @endif
        </div>
        <div
            @class(['pp-photo__drop', 'pp-photo__drop--error' => $error])
            ondragover="event.preventDefault(); this.classList.add('pp-photo__drop--over')"
            ondragleave="this.classList.remove('pp-photo__drop--over')"
            ondrop="event.preventDefault(); this.classList.remove('pp-photo__drop--over'); const input = this.querySelector('input'); input.files = event.dataTransfer.files; input.dispatchEvent(new Event('change'))"
        >
            <input
                id="{{ $id }}"
                name="{{ $name }}"
                type="file"
                accept="image/jpeg,image/png"
                class="sr-only"
                aria-labelledby="{{ $id }}-label"
                aria-describedby="{{ $id }}-hint"
                @disabled($loading)
                onchange="const file = this.files[0]; if (file) { this.closest('.pp-photo').querySelector('.pp-photo__preview').innerHTML = '<img alt=&quot;&quot;>'; this.closest('.pp-photo').querySelector('.pp-photo__preview img').src = URL.createObjectURL(file); }"
            >
            <label for="{{ $id }}" class="pp-btn pp-btn--secondary pp-btn--sm">
                <x-icon :name="$src ? 'camera' : 'upload'" :width="16" :height="16" />
                {{ $src ? 'Trocar foto' : 'Enviar foto' }}
            </label>
            <p class="pp-hint" id="{{ $id }}-hint">{{ $hint }} Ou arraste a imagem para cá.</p>
        </div>
    </div>
    @if ($error)
        <p class="pp-error" role="alert"><x-icon name="circle-alert" :width="16" :height="16" />{{ $error }}</p>
    @endif
</div>
