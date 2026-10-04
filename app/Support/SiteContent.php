<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Conteúdo de exemplo do site (ui_kits/site/data.js do design system).
 *
 * ponytail: eventos, CFP e propostas são fictícios e estáticos; troque por models quando o banco chegar (ADR 0001 §2).
 */
class SiteContent
{
    /**
     * @return array<string, array{id: string, title: string, type: string, modality: string, date: string, time?: string, place: string, register_url?: string, cfp_open?: bool, about?: string}>
     */
    public static function events(): array
    {
        return [
            'conf26' => ['id' => 'conf26', 'title' => 'PHP Piauí Conf 2026', 'type' => 'evento', 'modality' => 'hibrido', 'date' => 'sáb, 21 de novembro de 2026', 'time' => '8h–18h', 'place' => 'Centro de Convenções de Teresina · transmissão no YouTube', 'register_url' => 'https://www.sympla.com.br/', 'cfp_open' => true,
                'about'       => 'Um dia inteiro de palestras, lightning talks e workshops sobre PHP, Laravel e tudo o que roda em volta: testes, filas, deploy, carreira. Entrada gratuita, vagas limitadas no presencial.'],
            'm32' => ['id' => 'm32', 'title' => 'Meetup #32 — Testes que não quebram', 'type' => 'meetup', 'modality' => 'presencial', 'date' => 'qui, 15 de outubro de 2026', 'time' => '19h–21h30', 'place' => 'Café com Código, Av. Frei Serafim, Teresina', 'register_url' => 'https://www.sympla.com.br/'],
        ];
    }

    /**
     * @return array<string, array{id: string, title: string, type: string, modality: string, date: string, place: string}>
     */
    public static function pastEvents(): array
    {
        return [
            'm31'   => ['id' => 'm31', 'title' => 'Meetup #31 — PHP 8.4 na prática', 'type' => 'meetup', 'modality' => 'presencial', 'date' => '12 de março de 2026', 'place' => 'IFPI Campus Teresina Central'],
            'm30'   => ['id' => 'm30', 'title' => 'Meetup #30 — Livewire 3 do zero', 'type' => 'meetup', 'modality' => 'online', 'date' => '5 de dezembro de 2025', 'place' => 'YouTube · @PHP-Piauí'],
            'day25' => ['id' => 'day25', 'title' => 'PHP Piauí Day 2025', 'type' => 'evento', 'modality' => 'presencial', 'date' => '18 de outubro de 2025', 'place' => 'UESPI Parnaíba'],
            'm29'   => ['id' => 'm29', 'title' => 'Meetup #29 — Filas e jobs', 'type' => 'meetup', 'modality' => 'hibrido', 'date' => '9 de agosto de 2025', 'place' => 'UFPI · CCN'],
            'm28'   => ['id' => 'm28', 'title' => 'Meetup #28 — Carreira em PHP', 'type' => 'meetup', 'modality' => 'online', 'date' => '14 de junho de 2025', 'place' => 'YouTube · @PHP-Piauí'],
            'm27'   => ['id' => 'm27', 'title' => 'Meetup #27 — Composer além do require', 'type' => 'meetup', 'modality' => 'presencial', 'date' => '12 de abril de 2025', 'place' => 'Coworking Poti'],
        ];
    }

    /**
     * @return list<array{time: string, title: string, kind?: string, format?: string, speakers?: list<array{name: string, role: string}>}>
     */
    public static function schedule(): array
    {
        return [
            ['time' => '8h00', 'title' => 'Credenciamento e café regional', 'kind' => 'break'],
            ['time' => '8h45', 'title' => 'Abertura: 10 anos de PHP no Piauí', 'format' => 'palestra', 'speakers' => [['name' => 'Rafaela Moura', 'role' => 'Organização PHP Piauí']]],
            ['time' => '9h30', 'title' => 'Filas no Laravel sem dor de cabeça', 'format' => 'palestra', 'speakers' => [['name' => 'Ana Sousa', 'role' => 'Dev backend']]],
            ['time' => '10h20', 'title' => 'Meu primeiro pacote no Packagist', 'format' => 'lightning', 'speakers' => [['name' => 'João Nunes', 'role' => 'Estudante, UFPI']]],
            ['time' => '10h30', 'title' => 'O que aprendi migrando um legado para PHP 8.4', 'format' => 'lightning', 'speakers' => [['name' => 'Carlos Brito', 'role' => 'Dev, Prefeitura de Teresina']]],
            ['time' => '12h00', 'title' => 'Almoço livre', 'kind' => 'break'],
            ['time' => '13h30', 'title' => 'Workshop: Docker para quem tem medo', 'format' => 'workshop', 'speakers' => [['name' => 'Marina Lopes', 'role' => 'DevOps'], ['name' => 'Pedro Lima', 'role' => 'SRE']]],
        ];
    }

    /**
     * @return list<array{name: string, role: string, bio: string, socials: list<array{network: string, url: string}>}>
     */
    public static function speakers(): array
    {
        return [
            ['name' => 'Ana Sousa', 'role' => 'Dev backend · Teresina', 'bio' => 'Escreve PHP desde o 5.6 e hoje cuida de filas e integrações de pagamento. Gosta de testes, café e de explicar as coisas devagar.', 'socials' => [['network' => 'github', 'url' => '#'], ['network' => 'linkedin', 'url' => '#']]],
            ['name' => 'João Nunes', 'role' => 'Estudante de Computação, UFPI', 'bio' => 'Publicou o primeiro pacote no ano passado e quer convencer mais gente a fazer o mesmo. Primeira palestra!', 'socials' => [['network' => 'github', 'url' => '#'], ['network' => 'instagram', 'url' => '#']]],
            ['name' => 'Marina Lopes', 'role' => 'DevOps · Parnaíba', 'bio' => 'Transforma "na minha máquina funciona" em pipeline. Já subiu containers em servidor embaixo de mesa.', 'socials' => [['network' => 'linkedin', 'url' => '#'], ['network' => 'site', 'url' => '#']]],
        ];
    }

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
     * @return array{event: string, deadline_label: string, deadline: string}
     */
    public static function cfp(): array
    {
        return ['event' => 'PHP Piauí Conf 2026', 'deadline_label' => '30 de outubro, 23h59', 'deadline' => '2026-10-30T23:59:00-03:00'];
    }

    /**
     * Propostas do CFP aberto, como o painel admin vê.
     *
     * @return list<array{id: int, title: string, speaker: string, format: string, sent_at: string, status: string}>
     */
    public static function proposals(): array
    {
        return [
            ['id' => 1, 'title' => 'Pest + Livewire: testando componentes sem sofrimento', 'speaker' => 'Ana Sousa', 'format' => 'palestra', 'sent_at' => '02/10/2026', 'status' => 'review'],
            ['id' => 2, 'title' => 'Meu primeiro pacote no Packagist', 'speaker' => 'João Nunes', 'format' => 'lightning', 'sent_at' => '01/10/2026', 'status' => 'approved'],
            ['id' => 3, 'title' => 'Docker para quem tem medo', 'speaker' => 'Marina Lopes', 'format' => 'workshop', 'sent_at' => '28/09/2026', 'status' => 'review'],
            ['id' => 4, 'title' => 'Enums e readonly em produção', 'speaker' => 'Carlos Brito', 'format' => 'palestra', 'sent_at' => '25/09/2026', 'status' => 'rejected'],
            ['id' => 5, 'title' => 'Observabilidade com OpenTelemetry', 'speaker' => 'Lia Fontenele', 'format' => 'palestra', 'sent_at' => '24/09/2026', 'status' => 'review'],
        ];
    }

    /**
     * Propostas da palestrante logada.
     *
     * @return array<int, array{id: int, title: string, format: string, sent_at: string, status: string, event: string, decided_at?: string}>
     */
    public static function myProposals(): array
    {
        return [
            11 => ['id' => 11, 'title' => 'Filas no Laravel sem dor de cabeça', 'format' => 'palestra', 'sent_at' => '02/10/2026', 'status' => 'review', 'event' => 'PHP Piauí Conf 2026'],
            12 => ['id' => 12, 'title' => 'Como o PHP paga meu aluguel', 'format' => 'lightning', 'sent_at' => '10/02/2026', 'status' => 'approved', 'event' => 'Meetup #31', 'decided_at' => '20/02/2026'],
            13 => ['id' => 13, 'title' => 'Arquitetura hexagonal em 40 minutos', 'format' => 'palestra', 'sent_at' => '01/08/2025', 'status' => 'rejected', 'event' => 'PHP Piauí Day 2025', 'decided_at' => '15/08/2025'],
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
