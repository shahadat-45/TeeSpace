<style>
    .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    }

    .pagination li {
        margin: 0 5px;
        height: 40px;
        display: flex;
        width: 40px;
        line-height: 40px;
        background-color: transparent;
        justify-content: center;
        align-items: center;
        border-radius: 50%
    }
    .pagination li.active {
        background-color: black;
        color: #FFF;
    }
    .pagination li.active span{
        color: #FFF;
    }
    .pagination li a,
    .pagination li span {
        /* padding: 8px 12px;
        border-radius: 50%;
        background-color: black; */
        color: black;
        font-weight: bold
        /* text-decoration: none;
        transition: background-color 0.3s; */
    }

    .pagination li:hover {
        background-color: #DDD;
    }
    .pagination li.active:hover {
        background-color: #000000;
    }

    .pagination .disabled span {
        color: #aaa;
        cursor: not-allowed;
    }

</style>
@if ($paginator->total() > 0)
    <div class="pagination-summary">
        Showing {{ $paginator->firstItem() }} – {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </div>
@endif
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>«</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
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
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>
        @else
            <li class="disabled"><span>»</span></li>
        @endif
    </ul>
@endif
