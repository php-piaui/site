<?php

declare(strict_types=1);

test('renders talks with speakers and breaks', function () {
    $items = [
        ['time' => '19:00', 'title' => 'Filas no Laravel', 'format' => 'palestra', 'speakers' => [['name' => 'Ana Sousa', 'role' => 'Cajutec']]],
        ['time' => '20:00', 'title' => 'Coffee break', 'kind' => 'break'],
    ];

    $this->blade('<x-schedule :items="$items" />', ['items' => $items])
        ->assertSee('<time class="pp-slot__time">19:00</time>', false)
        ->assertSee('Ana Sousa')
        ->assertSee('Cajutec')
        ->assertSee('Palestra')
        ->assertSee('class="pp-slot pp-slot--break"', false);
});
