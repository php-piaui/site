<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProposalFormat;
use App\Enums\ProposalStatus;
use Database\Factories\ProposalFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Proposta enviada a um CFP. Editável só em revisão; aprovada ou recusada fica somente leitura (ADR 0001 §2.3).
 *
 * @property ProposalFormat $format
 * @property ProposalStatus $status
 * @property bool $first_talk
 * @property Carbon|null $decided_at
 * @property-read Cfp $cfp
 */
#[Fillable(['title', 'format', 'level', 'summary', 'notes', 'first_talk'])]
class Proposal extends Model
{
    /** @use HasFactory<ProposalFactory> */
    use HasFactory;

    public const LEVELS = ['Iniciante', 'Intermediário', 'Avançado', 'Todos os níveis'];

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'review',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'format'     => ProposalFormat::class,
            'status'     => ProposalStatus::class,
            'first_talk' => 'boolean',
            'decided_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Cfp, $this>
     */
    public function cfp(): BelongsTo
    {
        return $this->belongsTo(Cfp::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isDecided(): bool
    {
        return $this->status !== ProposalStatus::Review;
    }

    /**
     * Registra a decisão da organização; a proposta passa a ser somente leitura.
     */
    public function decide(ProposalStatus $status, ?string $message = null): void
    {
        $this->forceFill(['status' => $status, 'decision_message' => $message, 'decided_at' => now()])->save();
    }
}
