<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProposalFormat;
use App\Enums\ProposalStatus;
use App\Models\Cfp;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cfp_id'       => Cfp::factory(),
            'user_id'      => User::factory(),
            'speaker_name' => fn (array $attributes): string => User::find($attributes['user_id'])?->name ?? fake()->name(),
            'title'        => fake()->sentence(5),
            'format'       => ProposalFormat::Palestra,
            'level'        => 'Iniciante',
            'summary'      => fake()->paragraph(4),
            'notes'        => null,
            'first_talk'   => false,
            'status'       => ProposalStatus::Review,
        ];
    }

    public function approved(): static
    {
        return $this->state(['status' => ProposalStatus::Approved, 'decided_at' => now()]);
    }

    public function rejected(): static
    {
        return $this->state(['status' => ProposalStatus::Rejected, 'decided_at' => now()]);
    }
}
