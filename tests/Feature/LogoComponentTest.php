<?php

declare(strict_types=1);

test('renders the horizontal lockup with wordmark', function () {
    $this->blade('<x-logo />')
        ->assertSee('role="img" aria-label="PHP Piauí"', false)
        ->assertSee('width="50" height="40"', false)
        ->assertSee('fill="var(--fg-brand)"', false)
        ->assertSee('font-size: 24px', false);
});

test('switches to the simplified symbol below 32px', function () {
    $this->blade('<x-logo variant="symbol" :size="24" tone="white" />')
        ->assertSee('fill="#FFFFFF"', false)
        ->assertSee('d="M178.22 2', false)
        ->assertDontSee('PHP Piauí</span>', false);
});

test('renders the short vertical wordmark', function () {
    $this->blade('<x-logo variant="vertical" short />')
        ->assertSee('flex-direction: column', false)
        ->assertSee('PHPPI');
});
