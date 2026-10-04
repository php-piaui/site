<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\EventModality;
use App\Enums\EventType;
use App\Enums\ProposalFormat;
use App\Enums\ProposalStatus;
use App\Models\Event;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Conteúdo de exemplo do protótipo (ui_kits/site/data.js do design system). Todo fictício.
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create(['name' => 'Organização PHP Piauí', 'email' => 'admin@phppiaui.com.br']);
        $ana = User::factory()->create([
            'name'     => 'Ana Sousa',
            'email'    => 'ana@example.com',
            'headline' => 'Dev backend · Teresina',
            'bio'      => 'Escreve PHP desde o 5.6 e hoje cuida de filas e integrações de pagamento. Gosta de testes, café e de explicar as coisas devagar.',
            'github'   => 'github.com/anasousa',
            'linkedin' => 'anasousa',
        ]);

        $conf = Event::factory()->create([
            'title'       => 'PHP Piauí Conf 2026', 'type' => EventType::Evento, 'modality' => EventModality::Hibrido,
            'starts_at'   => now()->addWeeks(7)->setTime(8, 0), 'ends_at' => now()->addWeeks(7)->setTime(18, 0),
            'place'       => 'Centro de Convenções de Teresina · transmissão no YouTube',
            'description' => 'Um dia inteiro de palestras, lightning talks e workshops sobre PHP, Laravel e tudo o que roda em volta: testes, filas, deploy, carreira. Entrada gratuita, vagas limitadas no presencial.',
        ]);
        Event::factory()->create([
            'title'     => 'Meetup #32 — Testes que não quebram',
            'starts_at' => now()->addWeeks(2)->setTime(19, 0), 'ends_at' => now()->addWeeks(2)->setTime(21, 30),
            'place'     => 'Café com Código, Av. Frei Serafim, Teresina',
        ]);
        foreach ([
            ['Meetup #31 — PHP 8.4 na prática', EventModality::Presencial, 'IFPI Campus Teresina Central'],
            ['Meetup #30 — Livewire 3 do zero', EventModality::Online, 'YouTube · @PHP-Piauí'],
            ['Meetup #29 — Filas e jobs', EventModality::Hibrido, 'UFPI · CCN'],
            ['Meetup #28 — Carreira em PHP', EventModality::Online, 'YouTube · @PHP-Piauí'],
            ['Meetup #27 — Composer além do require', EventModality::Presencial, 'Coworking Poti'],
        ] as $index => [$title, $modality, $place]) {
            Event::factory()->create(['title' => $title, 'modality' => $modality, 'place' => $place, 'starts_at' => now()->subMonths(($index + 1) * 2)->setTime(19, 0), 'ends_at' => null]);
        }

        $cfp = $conf->cfp()->create([
            'opens_at'       => now()->subWeeks(2),
            'closes_at'      => now()->addWeeks(4)->setTime(23, 59),
            'formats'        => ProposalFormat::cases(),
            'show_countdown' => true,
        ]);

        Proposal::factory()->for($cfp)->for($ana)->create(['title' => 'Filas no Laravel sem dor de cabeça', 'speaker_name' => $ana->name]);
        foreach ([
            ['Meu primeiro pacote no Packagist', 'João Nunes', ProposalFormat::Microtalk, ProposalStatus::Approved],
            ['Docker para quem tem medo', 'Marina Lopes', ProposalFormat::Workshop, ProposalStatus::Review],
            ['Enums e readonly em produção', 'Carlos Brito', ProposalFormat::Palestra, ProposalStatus::Rejected],
            ['Observabilidade com OpenTelemetry', 'Lia Fontenele', ProposalFormat::Palestra, ProposalStatus::Review],
        ] as [$title, $name, $format, $status]) {
            $speaker = User::factory()->create(['name' => $name]);
            Proposal::factory()->for($cfp)->for($speaker)->create([
                'title'      => $title, 'speaker_name' => $name, 'format' => $format, 'status' => $status,
                'decided_at' => $status === ProposalStatus::Review ? null : now(),
            ]);
        }
    }
}
