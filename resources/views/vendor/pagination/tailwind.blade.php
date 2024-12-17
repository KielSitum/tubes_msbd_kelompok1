@if ($paginator->hasPages())
    <div class="w-full flex flex-col justify-center items-center py-4 gap-8">
        <div class="w-full flex justify-center items-center h-fit">
            <div class="flex gap-4 items-center bg-blue-300 px-6 py-2 rounded-full">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center bg-white rounded-full text-blue-500 cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition duration-300">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="text-white font-semibold">...</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full font-bold shadow-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center bg-white text-blue-500 rounded-full hover:bg-blue-500 hover:text-white transition duration-300">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition duration-300">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center bg-white rounded-full text-blue-500 cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>

    </div>
@endif
