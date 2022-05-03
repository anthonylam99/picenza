<div class="card-footer">
    <div class="card-tools align-middle">
        <ul class="pagination pagination-sm float-right" style="margin-bottom: 0">
            @if ($itemPaginate->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $itemPaginate->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            <?php
            $start = $itemPaginate->currentPage() - 2; // show 3 pagination links before current
            $end = $itemPaginate->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $itemPaginate->lastPage() ) $end = $itemPaginate->lastPage(); // reset end to last page
            ?>

            @if($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $itemPaginate->url(1) }}">{{1}}</a>
                </li>
                @if($itemPaginate->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($itemPaginate->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $itemPaginate->url($i) }}">{{$i}}</a>
                </li>
            @endfor
            @if($end < $itemPaginate->lastPage())
                @if($itemPaginate->currentPage() + 3 != $itemPaginate->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $itemPaginate->url($itemPaginate->lastPage()) }}">{{$itemPaginate->lastPage()}}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($itemPaginate->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $itemPaginate->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>
</div>