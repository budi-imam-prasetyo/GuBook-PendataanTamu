@if ($paginator->hasPages())
    <nav class="w-full pb-2">
        <div class="flex justify-between items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="cursor-not-allowed rounded-lg border-2 border-gray-300 bg-gray-100 px-4 py-2 text-gray-500">
                    &laquo; Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="rounded-lg border-2 border-primaryBlue bg-white px-4 py-2 text-blue-600 hover:bg-gray-100">
                    &laquo; Sebelumnya
                </a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="rounded-lg border-2 border-primaryBlue bg-white px-4 py-2 text-blue-600 hover:bg-gray-100">
                    Selanjutnya &raquo;
                </a>
            @else
                <span class="cursor-not-allowed rounded-lg border-2 border-gray-300 bg-gray-100 px-4 py-2 text-gray-500">
                    Selanjutnya &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif