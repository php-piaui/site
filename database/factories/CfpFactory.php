<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProposalFormat;
use App\Models\Cfp;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cfp>
 */
class CfpFactory extends Factory
{
    /**
     * Aberto por padrão.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id'       => Event::factory(),
            'opens_at'       => now()->subWeek(),
            'closes_at'      => now()->addWeeks(3)->setTime(23, 59),
            'formats'        => ProposalFormat::cases(),
            'rules'          => null,
            'show_countdown' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(['opens_at' => now()->subMonth(), 'closes_at' => now()->subDay()]);
    }
}
