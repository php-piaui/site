<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'headline'  => ['nullable', 'string', 'max:255'],
            'bio'       => ['nullable', 'string', 'max:280'],
            'github'    => ['nullable', 'string', 'max:255'],
            'linkedin'  => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'website'   => ['nullable', 'url', 'max:255'],
            'photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    /**
     * Campos de texto do perfil; a foto é tratada à parte. Campo vazio vira null.
     *
     * @return array<string, string|null>
     */
    public function profileAttributes(): array
    {
        $attributes = [];

        foreach (['name', 'headline', 'bio', 'github', 'linkedin', 'instagram', 'website'] as $field) {
            $attributes[$field] = $this->filled($field) ? $this->string($field)->toString() : null;
        }

        return $attributes;
    }
}
