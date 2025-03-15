<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
            </a>
        </li>

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
            </a>
        </li>
    </ul>
</nav>
