<div class="ui pagination menu">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <a class="disabled item"><i class="icon angle left"></i>Prev</a>
    @else
        <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="icon angle left"></i> Prev</a>
    @endif

    <!-- Next Page ank -->
    @if ($paginator->hasMorePages())
        <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next">Next <i class="icon angle right"></i></a>
    @else
        <a class="disabled item">Next <i class="icon angle right"></i></a>
    @endif
</div>
