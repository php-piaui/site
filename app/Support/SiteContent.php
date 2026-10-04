<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Conteúdo institucional que vive no código, não no banco (ADR 0001 §2).
 */
class SiteContent
{
    /**
     * Apoiadores em ordem alfabética, todos com o mesmo destaque (ADR 0001 §2.4).
     *
     * @return list<array{name: string, logo: string, url: string, shape?: string}>
     */
    public static function supporters(): array
    {
        return [
            ['name' => 'Cajutec', 'logo' => asset('images/supporters/cajutec.webp'), 'url' => 'https://app.cajutec.com.br/'],
            ['name' => 'Geffin', 'logo' => asset('images/supporters/geffin.svg'), 'url' => 'https://geffin.com.br/', 'shape' => 'square'],
        ];
    }

    /**
     * Destino de "Submeter proposta": quem não tem conta vê antes a explicação do porquê (ADR 0001 §2.3).
     */
    public static function submitUrl(): string
    {
        return auth()->check() ? route('proposals.create') : route('cfp.show', ['conta' => 1]);
    }
}
