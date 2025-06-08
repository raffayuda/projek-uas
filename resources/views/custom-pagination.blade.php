{{-- Custom Pagination View --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-gray-400 bg-white rounded-lg cursor-not-allowed border border-gray-200">
                    <i class="fas fa-chevron-left mr-1"></i>
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="px-4 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-50 border border-gray-200 transition-colors">
                    <i class="fas fa-chevron-left mr-1"></i>
                    Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg font-semibold shadow-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="px-4 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-50 border border-gray-200 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="px-4 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-50 border border-gray-200 transition-colors">
                    Next
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            @else
                <span class="px-4 py-2 text-gray-400 bg-white rounded-lg cursor-not-allowed border border-gray-200">
                    Next
                    <i class="fas fa-chevron-right ml-1"></i>
                </span>
            @endif
        </div>
    </nav>

    {{-- Results Summary --}}
    <div class="mt-4 text-center text-sm text-gray-600">
        Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} mobil
    </div>
@endif
