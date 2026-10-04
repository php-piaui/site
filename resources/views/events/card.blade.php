{{-- x-event-card a partir de um App\Models\Event. Uso: @include('events.card', ['event' => $event, 'featured' => true]) --}}
<x-event-card
    :featured="$featured ?? false"
    :past="$event->isPast()"
    :title="$event->title"
    :type="$event->type->value"
    :modality="$event->modality->value"
    :date="$event->dateLabel()"
    :time="$event->isPast() ? null : $event->timeLabel()"
    :place="$event->place"
    :register-url="$event->register_url"
    :cfp-open="(bool) $event->cfp?->isOpen()"
    :href="route('events.show', $event)"
/>
