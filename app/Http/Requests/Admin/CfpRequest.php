<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Enums\ProposalFormat;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CfpRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id'       => ['required', Rule::exists('events', 'id'), Rule::unique('cfps', 'event_id')],
            'opens_at'       => ['required', 'date'],
            'closes_at'      => ['required', 'date', 'after:opens_at'],
            'formats'        => ['required', 'array', 'min:1'],
            'formats.*'      => [Rule::enum(ProposalFormat::class)],
            'rules'          => ['nullable', 'string', 'max:2000'],
            'show_countdown' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return ['event_id.unique' => 'Este evento já tem um CFP.'];
    }
}
