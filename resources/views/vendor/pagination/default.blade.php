@if ($paginator->lastPage() > 1)
    <div class="ui pagination menu">
        <a class="item {{ ($paginator->currentPage() == 1) ? 'disabled':'' }}item" href="{{ $paginator->url(1) }}">
            First
         </a>
         <?php
            $half_total_links = floor(4 / 2);
            $from = ($paginator->currentPage() - $half_total_links) < 1 ? 1 : $paginator->currentPage() - $half_total_links;
            $to = ($paginator->currentPage() + $half_total_links) > $paginator->lastPage() ? $paginator->lastPage() : ($paginator->currentPage() + $half_total_links);
            if ($from > $paginator->lastPage() - 4) {
               $from = ($paginator->lastPage() - 4) + 1;
               $to = $paginator->lastPage();
            }
            if ($to <= 4) {
                $from = 1;
                $to = 4 < $paginator->lastPage() ? 4 : $paginator->lastPage();
            }
        ?>
        @for ($i = $from; $i <= $to; $i++)
                <a class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} item" href="{{ $paginator->url($i) }}">{{ $i }}
                </a>
        @endfor
        <a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} item" href="{{ $paginator->url($paginator->lastPage()) }}">
            Last
        </a>
    </div>
@endif