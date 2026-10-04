{{--
    Paginação numerada (components/navigation/Pagination); compact troca os números por "Página x de y".
    Uso: <x-pagination :paginator="$proposals" /> · <x-pagination :paginator="$events" compact />
--}}
@props([
    'paginator',
    'compact' => false,
])

@php
    $page = $paginator->currentPage();
    $total = $paginator->lastPage();
    $pages = $total <= 7
        ? range(1, $total)
        : collect([1, $total, $page - 1, $page, $page + 1])->filter(fn (int $n): bool => $n >= 1 && $n <= $total)->unique()->sort()->values()->all();
@endphp

<nav aria-label="Paginação" {{ $attributes->class('pp-pagination') }}>
    @if ($page > 1)
        <a class="pp-page pp-page--nav" href="{{ $paginator->url($page - 1) }}" rel="prev"><x-icon name="chevron-left" :width="18" :height="18" /><span>Anterior</span></a>
    @else
        <span class="pp-page pp-page--nav" aria-disabled="true"><x-icon name="chevron-left" :width="18" :height="18" /><span>Anterior</span></span>
    @endif
    @if ($compact)
        <span class="pp-pagination__status">Página {{ $page }} de {{ $total }}</span>
    @else
        @foreach ($pages as $n)
            @if (! $loop->first && $n - $pages[$loop->index - 1] > 1)
                <span class="pp-page__gap" aria-hidden="true">…</span>
            @endif
            <a class="pp-page" href="{{ $paginator->url($n) }}" aria-label="Página {{ $n }}" @if ($n === $page) aria-current="page" @endif>{{ $n }}</a>
        @endforeach
    @endif
    @if ($page < $total)
        <a class="pp-page pp-page--nav" href="{{ $paginator->url($page + 1) }}" rel="next"><span>Próxima</span><x-icon name="chevron-right" :width="18" :height="18" /></a>
    @else
        <span class="pp-page pp-page--nav" aria-disabled="true"><span>Próxima</span><x-icon name="chevron-right" :width="18" :height="18" /></span>
    @endif
</nav>
