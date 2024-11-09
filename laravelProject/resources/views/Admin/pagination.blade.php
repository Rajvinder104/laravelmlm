@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- First Page Link --}}
        @if (!$paginator->onFirstPage())
            <li><a href="{{ $paginator->url(1) }}" rel="first">First</a></li>
        @else
            <li class="disabled"><span>First</span></li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo; Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    {{-- Always show first 2 pages and the last page --}}
                    @if ($page <= 2)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                        {{-- Show "..." separator for pages between 2 and last page --}}
                    @elseif ($page == 3 && $paginator->currentPage() > 4)
                        <li class="disabled"><span>...</span></li>
                        {{-- Always show the active page if it's beyond the first 2 pages --}}
                    @elseif ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
        @else
            <li class="disabled"><span>Next &raquo;</span></li>
        @endif

        {{-- Last Page Link --}}
        @if (!$paginator->onLastPage())
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}" rel="last">Last</a></li>
        @else
            <li class="disabled"><span>Last</span></li>
        @endif
    </ul>
@endif

{{-- Showing X to Y of Z Results --}}
<div class="pagination-info">
    <p>
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </p>
</div>
