
@if ($paginator->hasPages())
<div class="mt-4">
    <div class="text-16 mt-4"><span>Showing {{ $paginator->firstItem() }}</span> to <span id="page-to">{{ $paginator->lastItem() }} </span> of <span>{{ $paginator->total() }}</span> entries</div>
</div>

<div class="mt-4">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
        @endif
    
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif
    
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a  href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    
    
        
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next </span>
            </li>
        @endif
    </ul>
</div>
@endif 



