<div class="box-footer clearfix">
    @if ($paginator->hasPages())
        <div class="box-body  pull-left">
            <p class="text-aqua">
                {{ ($paginator->currentpage() - 1) * $paginator->perpage() + 1 }} to
                @if($paginator->currentpage()*$paginator->perpage() > $paginator->total())
                    {{$paginator->total()}}
                @else
                    {{ $paginator->currentpage() *$paginator->perpage()}}
                @endif of
                {{$paginator->total()}} entries
            </p>
        </div>
        <ul class="pagination pagination-sm no-margin pull-right">
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
</div>