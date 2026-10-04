<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Tipo de evento; os valores batem com os presets do x-badge.
 */
enum EventType: string
{
    case Meetup = 'meetup';
    case Evento = 'evento';
}
