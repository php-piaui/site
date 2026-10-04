<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ProposalFormat;
use App\Models\Cfp;
use App\Models\Proposal;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Envio e edição de proposta. O formato precisa estar entre os aceitos pelo CFP.
 */
class ProposalRequest extends FormRequest
{
    public function authorize(): bool
    {
        $proposal = $this->route('proposal');

        return $proposal instanceof Proposal ? ($this->user()?->can('update', $proposal) ?? false) : true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $formats = $this->cfp()?->formats->map(fn (ProposalFormat $format): string => $format->value)->all() ?? [];

        return [
            'title'      => ['required', 'string', 'max:90'],
            'format'     => ['required', Rule::in($formats)],
            'level'      => ['required', Rule::in(Proposal::LEVELS)],
            'summary'    => ['required', 'string', 'min:80', 'max:600'],
            'notes'      => ['nullable', 'string', 'max:1000'],
            'first_talk' => ['required', 'boolean'],
            'conduct'    => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Dê um título para a proposta.',
            'summary.required' => 'Escreva pelo menos 80 caracteres. Conte o que a plateia vai aprender.',
            'summary.min'      => 'Escreva pelo menos 80 caracteres. Conte o que a plateia vai aprender.',
            'conduct.accepted' => 'É preciso concordar com o código de conduta.',
        ];
    }

    /**
     * Campos validados que vão para o model (sem o aceite do código de conduta).
     *
     * @return array<string, mixed>
     */
    public function proposalAttributes(): array
    {
        return [
            'title'      => $this->string('title')->toString(),
            'format'     => $this->enum('format', ProposalFormat::class),
            'level'      => $this->string('level')->toString(),
            'summary'    => $this->string('summary')->toString(),
            'notes'      => $this->filled('notes') ? $this->string('notes')->toString() : null,
            'first_talk' => $this->boolean('first_talk'),
        ];
    }

    public function cfp(): ?Cfp
    {
        $proposal = $this->route('proposal');

        return $proposal instanceof Proposal ? $proposal->cfp : Cfp::open()->first();
    }
}
