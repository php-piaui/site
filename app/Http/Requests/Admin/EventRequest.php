<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Enums\EventModality;
use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', Rule::enum(EventType::class)],
            'modality'     => ['required', Rule::enum(EventModality::class)],
            'date'         => ['required', 'date_format:Y-m-d'],
            'starts_at'    => ['required', 'date_format:H:i'],
            'ends_at'      => ['nullable', 'date_format:H:i', 'after:starts_at'],
            'place'        => ['required', 'string', 'max:255'],
            'register_url' => ['required', 'url', 'max:255'],
            'description'  => ['nullable', 'string', 'max:800'],
        ];
    }

    /**
     * Campos do model a partir do formulário: data + horários viram datetimes; "Salvar rascunho" despublica.
     *
     * @return array<string, mixed>
     */
    public function eventAttributes(?Event $event = null): array
    {
        $date = $this->string('date')->toString();

        return [
            'title'        => $this->string('title')->toString(),
            'type'         => $this->enum('type', EventType::class),
            'modality'     => $this->enum('modality', EventModality::class),
            'place'        => $this->string('place')->toString(),
            'register_url' => $this->string('register_url')->toString(),
            'description'  => $this->filled('description') ? $this->string('description')->toString() : null,
            'starts_at'    => Carbon::parse($date.' '.$this->string('starts_at')),
            'ends_at'      => $this->filled('ends_at') ? Carbon::parse($date.' '.$this->string('ends_at')) : null,
            'published_at' => $this->boolean('draft') ? null : ($event->published_at ?? now()),
        ];
    }
}
