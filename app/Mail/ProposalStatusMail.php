<?php

declare(strict_types=1);

namespace App\Mail;

use App\Enums\ProposalStatus;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail ao palestrante quando a proposta chega ou recebe decisão (ADR 0001 §2.3).
 * Síncrono: a hospedagem compartilhada não tem worker de fila.
 */
class ProposalStatusMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Proposal $proposal)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: match ($this->proposal->status) {
            ProposalStatus::Review   => 'Recebemos sua proposta',
            ProposalStatus::Approved => 'Sua proposta foi aprovada',
            ProposalStatus::Rejected => 'Resposta sobre sua proposta',
        });
    }

    public function content(): Content
    {
        $status = $this->proposal->status;

        return new Content(
            view: 'emails.proposal-status',
            with: [
                'status'   => ['review' => 'recebida', 'approved' => 'aprovada', 'rejected' => 'recusada'][$status->value],
                'nome'     => str($this->proposal->speaker_name)->before(' ')->toString(),
                'titulo'   => $this->proposal->title,
                'evento'   => $this->proposal->cfp->event->title,
                'mensagem' => $this->proposal->decision_message,
                'url'      => $status === ProposalStatus::Rejected ? route('events.index') : route('proposals.show', $this->proposal),
            ],
        );
    }
}
