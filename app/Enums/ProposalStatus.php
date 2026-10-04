<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Ciclo da proposta (ADR 0001 §2.3): em revisão → aprovada ou recusada. Os valores batem com os presets do x-badge.
 */
enum ProposalStatus: string
{
    case Review   = 'review';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Review   => 'Em revisão',
            self::Approved => 'Aprovada',
            self::Rejected => 'Recusada',
        };
    }
}
