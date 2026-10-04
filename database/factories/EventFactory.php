<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EventModality;
use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('+1 week', '+3 months')->setTime(19, 0);

        return [
            'title'        => 'Meetup #'.fake()->unique()->numberBetween(1, 999).' — '.fake()->words(3, true),
            'type'         => EventType::Meetup,
            'modality'     => EventModality::Presencial,
            'starts_at'    => $startsAt,
            'ends_at'      => (clone $startsAt)->modify('+150 minutes'),
            'place'        => 'Teresina',
            'register_url' => 'https://www.sympla.com.br/',
            'description'  => fake()->paragraph(),
            'published_at' => now(),
        ];
    }

    public function past(): static
    {
        return $this->state(function (): array {
            $startsAt = fake()->dateTimeBetween('-2 years', '-1 week')->setTime(19, 0);

            return ['starts_at' => $startsAt, 'ends_at' => (clone $startsAt)->modify('+150 minutes')];
        });
    }

    public function draft(): static
    {
        return $this->state(['published_at' => null]);
    }
}
