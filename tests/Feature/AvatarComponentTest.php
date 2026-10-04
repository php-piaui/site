<?php

declare(strict_types=1);

test('renders up to two initials sized from the prop', function () {
    $this->blade('<x-avatar name="ana maria sousa" :size="36" />')
        ->assertSee('style="width: 36px; height: 36px; font-size: 12.96px"', false)
        ->assertSee('<span aria-hidden="true">AM</span>', false);
});

test('renders the photo instead of initials', function () {
    $this->blade('<x-avatar name="Ana Sousa" src="/a.jpg" />')
        ->assertSee('<img src="/a.jpg" alt="">', false)
        ->assertDontSee('AS');
});
