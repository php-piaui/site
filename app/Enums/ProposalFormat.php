<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Formatos de proposta; os valores batem com os presets do x-badge.
 */
enum ProposalFormat: string
{
    case Palestra  = 'palestra';
    case Microtalk = 'microtalk';
    case Workshop  = 'workshop';

    public function label(): string
    {
        return match ($this) {
            self::Palestra  => 'Palestra',
            self::Microtalk => 'Microtalk',
            self::Workshop  => 'Workshop',
        };
    }

    public function duration(): string
    {
        return match ($this) {
            self::Palestra  => '30 a 40 minutos',
            self::Microtalk => '5 a 10 minutos',
            self::Workshop  => '2 horas, mão na massa',
        };
    }

    public function pitch(): string
    {
        return match ($this) {
            self::Palestra  => 'Um tema com começo, meio e fim. Ideal para contar um caso real.',
            self::Microtalk => 'Uma ideia, uma dica, uma ferramenta. O melhor formato para estrear.',
            self::Workshop  => 'Turma de até 25 pessoas com computador. Precisa de roteiro prático.',
        };
    }
}
