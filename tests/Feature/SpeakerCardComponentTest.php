<?php

declare(strict_types=1);

test('renders speaker info and labelled social links', function () {
    $socials = [['network' => 'github', 'url' => 'https://github.com/ana'], ['network' => 'site', 'url' => 'https://ana.dev']];

    $this->blade('<x-speaker-card name="Ana Sousa" role="Dev" bio="Fala de filas." :socials="$socials" />', ['socials' => $socials])
        ->assertSee('<h3 class="pp-speaker__name">Ana Sousa</h3>', false)
        ->assertSee('Fala de filas.')
        ->assertSee('aria-label="GitHub de Ana Sousa"', false)
        ->assertSee('aria-label="Site de Ana Sousa"', false)
        ->assertSee('target="_blank"', false);
});

test('omits optional sections', function () {
    $this->blade('<x-speaker-card name="Ana Sousa" />')
        ->assertDontSee('pp-speaker__bio', false)
        ->assertDontSee('pp-socials', false);
});
