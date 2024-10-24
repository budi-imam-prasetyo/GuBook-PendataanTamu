@if ($paginator->hasPages())
    <nav class="flex items-center justify-between p-4">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-red-600 hover:bg-gray-100">
                    Previous
                </a>
                {{--
                    @else
                    <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">Previous</span>
                --}}
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="ml-3 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-red-600 hover:bg-gray-100">
                    Next
                </a>
            @else
                <span
                    class="ml-3 cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500">
                    Next
                </span>
            @endif
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Menampilkan
                    <span class="font-medium">
                        {{ $paginator->firstItem() }}
                    </span>
                    -
                    <span class="font-medium">
                        {{ $paginator->lastItem() }}
                    </span>
                    dari
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    Pegawai
                </p>

            </div>
            <div>
                <ul class="inline-flex items-center space-x-1.5">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <span
                                class="ml-0 cursor-not-allowed rounded-2 rounded-l-lg border-2 border-grey bg-gray-200 px-3 py-2 leading-tight text-gray-500">
                                &laquo;
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                class="ml-0 rounded-2 rounded-l-lg border-2 border-primaryRed bg-white px-3 py-2 leading-tight text-red-600 hover:bg-gray-100">
                                &laquo;
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span
                                    class="cursor-not-allowed border border-gray-300 bg-white px-3 py-2 leading-tight text-gray-500">
                                    {{ $element }}
                                </span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                {{-- Show active page, first page, last page, and two pages around the current page --}}

                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <span
                                            class="cursor-default rounded-2 border-2 border-red-600 bg-primaryRed px-3 py-2 leading-tight text-light">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @elseif (
                                    $page == 1 ||
                                        $page == $paginator->lastPage() ||
                                        ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                                    <li>
                                        <a href="{{ $url }}"
                                            class="rounded-2 border-2 border-primaryRed bg-light px-3 py-2 leading-tight text-red-600 hover:bg-gray-100">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @elseif ($page == $paginator->currentPage() - 3 || $page == $paginator->currentPage() + 3)
                                    <li>
                                        <span
                                            class="cursor-not-allowed rounded-2 border-2 border-primaryRed bg-light px-2.5 py-2 leading-tight text-primaryRed">
                                            ...
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}

                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                                class="rounded-2 rounded-r-lg border-2 border-primaryRed bg-white px-3 py-2 leading-tight text-red-600 hover:bg-gray-100">
                                &raquo;
                            </a>
                        </li>
                    @else
                        <li>
                            <span
                                class="cursor-not-allowed rounded-2 rounded-r-lg border-2 border-primaryRed bg-gray-200 px-3 py-2 leading-tight text-gray-500">
                                &raquo;
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
