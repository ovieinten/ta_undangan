    <div class="tt-page__pagination">
        <div class="tt-pagination">
            @if ($paginator->onFirstPage())
                <a href="#" class="btn tt-pagination__prev disabled">Prev</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn tt-pagination__prev">Prev</a>
            @endif
            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <div class="tt-pagination__numbs disabled"><span>{{ $element }}</span></div>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="tt-pagination__numbs active"><span>{{ $page }}</span></div>
                        @else
                            <div class="tt-pagination__numbs"><a href="{{ $url }}">{{ $page }}</a></div>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn tt-pagination__next">Next</a>
            @else
                <a class="btn tt-pagination__next disabled">Next</a>
            @endif
        </div>
    </div>