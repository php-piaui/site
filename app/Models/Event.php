<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EventModality;
use App\Enums\EventType;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Meetup ou evento cadastrado pela organização (ADR 0001 §2.2). Sem published_at é rascunho.
 *
 * @property EventType $type
 * @property EventModality $modality
 * @property Carbon $starts_at
 * @property Carbon|null $ends_at
 * @property Carbon|null $published_at
 */
#[Fillable(['title', 'type', 'modality', 'starts_at', 'ends_at', 'place', 'register_url', 'description', 'published_at'])]
class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type'         => EventType::class,
            'modality'     => EventModality::class,
            'starts_at'    => 'datetime',
            'ends_at'      => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    /**
     * @return HasOne<Cfp, $this>
     */
    public function cfp(): HasOne
    {
        return $this->hasOne(Cfp::class);
    }

    /**
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }

    /**
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function upcoming(Builder $query): void
    {
        $query->where('starts_at', '>=', today())->orderBy('starts_at');
    }

    /**
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function past(Builder $query): void
    {
        $query->where('starts_at', '<', today())->orderByDesc('starts_at');
    }

    public function isPast(): bool
    {
        return $this->starts_at->lt(today());
    }

    /**
     * "sáb, 21 de novembro de 2026"
     */
    public function dateLabel(): string
    {
        return $this->starts_at->translatedFormat('D, j \d\e F \d\e Y');
    }

    /**
     * "8h–18h" · "19h–21h30"
     */
    public function timeLabel(): string
    {
        $hour = fn (Carbon $time): string => $time->format('G').'h'.($time->minute ? $time->format('i') : '');

        return $hour($this->starts_at).($this->ends_at ? '–'.$hour($this->ends_at) : '');
    }
}
