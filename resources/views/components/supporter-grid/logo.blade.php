{{-- Logo ou nome de um apoiador dentro da x-supporter-grid. --}}
@if (! empty($supporter['logo']))
    <img src="{{ $supporter['logo'] }}" alt="{{ $supporter['name'] }}">
@else
    <span class="pp-supporter__name">{{ $supporter['name'] }}</span>
@endif
