{{--
    Card de palestrante (components/content/SpeakerCard): foto, nome, cargo, bio curta e redes (alvos de 44px).
    socials: [['network' => 'github'|'linkedin'|'instagram'|'twitter'|'youtube'|'site', 'url' => '...']]
    Uso: <x-speaker-card name="Ana Sousa" role="Dev na Cajutec" bio="..." :socials="$socials" />
--}}
@props([
    'name',
    'role' => null,
    'bio' => null,
    'photo' => null,
    'socials' => [],
])

@php
    $networks = ['github' => 'GitHub', 'linkedin' => 'LinkedIn', 'instagram' => 'Instagram', 'twitter' => 'X/Twitter', 'youtube' => 'YouTube', 'site' => 'Site', 'globe' => 'Site'];
@endphp

<article {{ $attributes->class('pp-card pp-speaker') }}>
    <div class="pp-speaker__head">
        <x-avatar :name="$name" :src="$photo" :size="72" />
        <div>
            <h3 class="pp-speaker__name">{{ $name }}</h3>
            @if ($role)
                <p class="pp-speaker__role">{{ $role }}</p>
            @endif
        </div>
    </div>
    @if ($bio)
        <p class="pp-speaker__bio">{{ $bio }}</p>
    @endif
    @if (count($socials) > 0)
        <div class="pp-socials">
            @foreach ($socials as $social)
                <x-button
                    variant="ghost"
                    icon-only
                    :icon="$social['network'] === 'site' ? 'globe' : $social['network']"
                    :label="($networks[$social['network']] ?? $social['network']).' de '.$name"
                    :href="$social['url']"
                    target="_blank"
                    rel="noopener noreferrer"
                />
            @endforeach
        </div>
    @endif
</article>
