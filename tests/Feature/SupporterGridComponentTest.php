<?php

declare(strict_types=1);

test('renders linked logos and plain names', function () {
    $supporters = [
        ['name' => 'Cajutec', 'logo' => '/c.webp', 'url' => 'https://cajutec.com', 'shape' => 'square'],
        ['name' => 'Geffin'],
    ];

    $this->blade('<x-supporter-grid :supporters="$supporters" />', ['supporters' => $supporters])
        ->assertSee('class="pp-supporter pp-supporter--square" href="https://cajutec.com"', false)
        ->assertSee('<img src="/c.webp" alt="Cajutec">', false)
        ->assertSee('(abre em outro site)')
        ->assertSee('<div class="pp-supporter"><span class="pp-supporter__name">Geffin</span>', false);
});
