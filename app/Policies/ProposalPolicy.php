<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;

class ProposalPolicy
{
    /**
     * Só quem enviou vê a própria proposta pelo site; a organização usa o painel.
     */
    public function view(User $user, Proposal $proposal): bool
    {
        return $proposal->user_id === $user->id;
    }

    /**
     * Editável enquanto estiver em revisão (ADR 0001 §2.3).
     */
    public function update(User $user, Proposal $proposal): bool
    {
        return $this->view($user, $proposal) && ! $proposal->isDecided();
    }
}
