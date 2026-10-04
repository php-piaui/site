<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Modalidade do evento; os valores batem com os presets do x-badge.
 */
enum EventModality: string
{
    case Presencial = 'presencial';
    case Online     = 'online';
    case Hibrido    = 'hibrido';
}
