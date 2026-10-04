<?php

declare(strict_types=1);

test('renders checked checkbox with description and error', function () {
    $this->blade('<x-checkbox name="aceite" label="Aceito" description="Obrigatório." checked error="Marque para continuar." />')
        ->assertSee('class="pp-check" for="aceite"', false)
        ->assertSee('checked', false)
        ->assertSee('aria-describedby="aceite-error"', false)
        ->assertSee('<span class="pp-check__desc">Obrigatório.</span>', false)
        ->assertSee('Marque para continuar.');
});

test('renders disabled checkbox', function () {
    $this->blade('<x-checkbox name="x" label="X" disabled />')
        ->assertSee('class="pp-check pp-check--disabled"', false)
        ->assertSee('disabled', false);
});

test('renders radio group from associative and detailed options', function () {
    $options = [
        ['value' => 'presencial', 'label' => 'Presencial', 'description' => 'Em Teresina.'],
        ['value' => 'online', 'label' => 'Online', 'disabled' => true],
    ];

    $this->blade('<x-radio-group name="modalidade" legend="Modalidade" direction="row" :options="$options" value="presencial" />', ['options' => $options])
        ->assertSee('<legend class="pp-label">Modalidade</legend>', false)
        ->assertSee('flex-direction: row; gap: 24px', false)
        ->assertSee('value="presencial"'."\n".'                        checked', false)
        ->assertSee('class="pp-check pp-check--radio pp-check--disabled"', false)
        ->assertSee('Em Teresina.');

    $this->blade('<x-radio-group name="f" :options="[\'a\' => \'A\']" error="Escolha um." />')
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('Escolha um.');
});

test('renders photo upload with initials and preview', function () {
    $this->blade('<x-photo-upload initials="AS" />')
        ->assertSee('id="foto-label"', false)
        ->assertSee('type="file"', false)
        ->assertSee('aria-describedby="foto-hint"', false)
        ->assertSee('>AS</span>', false)
        ->assertSee('Enviar foto');

    $this->blade('<x-photo-upload name="photo" src="/a.jpg" error="Arquivo grande demais." />')
        ->assertSee('<img src="/a.jpg" alt="">', false)
        ->assertSee('pp-photo__drop pp-photo__drop--error', false)
        ->assertSee('Trocar foto')
        ->assertSee('Arquivo grande demais.');
});
