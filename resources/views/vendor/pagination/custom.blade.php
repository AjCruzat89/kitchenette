@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        @php
            $currentPage = $paginator->currentPage();
            $numLinks = 5; // Total number of page buttons to display
            $halfTotalLinks = floor($numLinks / 2);
            $from = max(1, $currentPage - $halfTotalLinks);
            $to = min($currentPage + $halfTotalLinks, $paginator->lastPage());
        @endphp

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Page Links --}}
        @for ($i = $from; $i <= $to; $i++)
            @if ($i == $currentPage)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
