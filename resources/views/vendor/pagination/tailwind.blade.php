@if ($paginator->hasPages())
    <nav role="navigation" class="mt-6 flex items-center justify-between">

        {{-- Info --}}
        <div class="text-sm text-gray-500">
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            dari {{ $paginator->total() }}
        </div>

        {{-- Pagination --}}
        <div class="flex items-center gap-2">

            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <span class="px-2 text-gray-300 cursor-not-allowed">
                    ‹
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-2 text-gray-500 hover:text-black transition">
                    ‹
                </a>
            @endif

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                $start = max($current - 2, 1);
                $end = min($current + 2, $last);
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <span class="px-4 py-1 text-black font-semibold border-b-2 border-black">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}"
                       class="px-4 py-1 text-gray-500 hover:text-black transition">
                        {{ $page }}
                    </a>
                @endif                
            @endfor

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-2 text-gray-500 hover:text-black transition">
                    ›
                </a>
            @else
                <span class="px-2 text-gray-300 cursor-not-allowed">
                    ›
                </span>
            @endif

        </div>
    </nav>
@endif