@if ($paginator->hasPages())
    <nav class="flex items-center justify-between p-4">
        <div class="flex-1 flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-300 rounded-md hover:bg-gray-100">Previous</a>
            {{-- @else
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">Previous</span> --}}
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 ml-3 text-sm font-medium text-blue-600 bg-white border border-gray-300 rounded-md hover:bg-gray-100">Next</a>
            @else
                <span class="px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">Next</span>
            @endif
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>
            <div>
                <ul class="inline-flex items-center space-x-1.5">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <span class="px-3 py-2 ml-0 leading-tight rounded-2 text-gray-500 bg-gray-200 border-2 border-grey rounded-l-lg cursor-not-allowed">&laquo;</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-2 ml-0 leading-tight rounded-2 text-blue-600 bg-white border-2 border-primaryBlue rounded-l-lg hover:bg-gray-100">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                {{-- Show active page, first page, last page, and two pages around the current page --}}
                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <span class="px-3 py-2 leading-tight rounded-2 text-light bg-primaryBlue border-2 border-blue-600 cursor-default">{{ $page }}</span>
                                    </li>
                                @elseif ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                                    <li>
                                        <a href="{{ $url }}" class="px-3 py-2 leading-tight rounded-2 text-blue-600 bg-light border-2 border-primaryBlue hover:bg-gray-100">{{ $page }}</a>
                                    </li>
                                @elseif ($page == $paginator->currentPage() - 3 || $page == $paginator->currentPage() + 3)
                                    <li>
                                        <span class="px-2.5 py-2 leading-tight rounded-2 text-primaryBlue bg-light border-2 border-primaryBlue cursor-not-allowed">...</span>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-2 leading-tight rounded-2 text-blue-600 bg-white border-2 border-primaryBlue rounded-r-lg hover:bg-gray-100">&raquo;</a>
                        </li>
                    @else
                        <li>
                            <span class="px-3 py-2 leading-tight rounded-2 text-gray-500 bg-gray-200 border-2 border-primaryBlue rounded-r-lg cursor-not-allowed">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
