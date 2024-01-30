<div class="pagination justify-content-center mt-4">
    @if ($paginator->onFirstPage())
        <span class="disabled">&lt;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}{{ request()->has('search') ? '&search=' . request('search') : '' }}#catalog-anchor" rel="prev">&lt;</a>
    @endif

    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        @if ($page == $paginator->currentPage())
            <span class="current">{{ $page }}</span>
        @else
            <a href="{{ $url }}{{ request()->has('search') ? '&search=' . request('search') : '' }}#catalog-anchor">{{ $page }}</a>
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}{{ request()->has('search') ? '&search=' . request('search') : '' }}#catalog-anchor" rel="next">&gt;</a>
    @else
        <span class="disabled">&gt;</span>
    @endif
</div>