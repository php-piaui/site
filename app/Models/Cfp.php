<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProposalFormat;
use Database\Factories\CfpFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Call for papers de um evento, com prazo e formatos aceitos (ADR 0001 §2.3).
 *
 * @property Carbon $opens_at
 * @property Carbon $closes_at
 * @property Collection<int, ProposalFormat> $formats
 * @property bool $show_countdown
 * @property-read Event $event
 */
#[Fillable(['event_id', 'opens_at', 'closes_at', 'formats', 'rules', 'show_countdown'])]
class Cfp extends Model
{
    /** @use HasFactory<CfpFactory> */
    use HasFactory;

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'opens_at'       => 'datetime',
            'closes_at'      => 'datetime',
            'formats'        => AsEnumCollection::of(ProposalFormat::class),
            'show_countdown' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Event, $this>
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return HasMany<Proposal, $this>
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function open(Builder $query): void
    {
        $query->where('opens_at', '<=', now())->where('closes_at', '>=', now())->orderBy('closes_at');
    }

    public function isOpen(): bool
    {
        return now()->between($this->opens_at, $this->closes_at);
    }

    /**
     * "30 de outubro, 23h59"
     */
    public function deadlineLabel(): string
    {
        return $this->closes_at->translatedFormat('j \d\e F, G\hi');
    }
}
