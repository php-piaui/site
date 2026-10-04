<?php

declare(strict_types=1);

test('renders a lucide icon from the design system subset', function () {
    $view = $this->blade('<x-icon name="check" class="size-4 text-cta" />');

    $view->assertSee('<path d="M20 6 9 17l-5-5" />', false)
        ->assertSee('class="shrink-0 size-4 text-cta"', false)
        ->assertSee('aria-hidden="true"', false);
});

test('fails loudly for an icon outside the subset', function () {
    expect(fn () => (string) $this->blade('<x-icon name="does-not-exist" />'))
        ->toThrow('Ícone [does-not-exist] não existe no subconjunto Lucide.');
});
