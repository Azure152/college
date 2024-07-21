@if ($paginator->hasPages())
    <nav>
        <div class="pagination">
            <div>
                <p class="">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span>{{ $paginator->firstItem() }}</span>
                        -
                        <span>{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span>{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div class="pagination__navegation">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="pagination__item">
                            <span>
                                &laquo; Anterior
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="pagination__item" rel="prev">
                            &laquo; Anterior
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span>
                                <span class="pagination__item">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="pagination__item" aria-current="page">
                                        <span>{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="pagination__item">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="pagination__item" rel="next">
                            Siguiente &raquo;
                        </a>
                    @else
                        <span class="pagination__item">
                            <span>
                                Siguiente &raquo;
                            </span>
                        </span>
                    @endif
            </div>
        </div>
    </nav>
@endif
