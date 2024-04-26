<div>
    @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between mt-2 gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <label class=" items-center px-4  text-sm font-medium text-gray-500 btn-disabled cursor-not-allowed btn btn-xs btn-outline leading-5 rounded-md ">
                {!! __('pagination.previous') !!}
            </label>
        @else
            <label wire:click="previousPage('{{ $paginator->getPageName() }}')" rel="prev" class=" items-center px-4  text-sm font-medium text-gray-700 btn-secondary  cursor-pointer btn btn-xs btn-outline">
                {!! __('pagination.previous') !!}
            </label>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <label wire:click="nextPage('{{ $paginator->getPageName() }}')" rel="next" class=" items-center px-4  text-sm font-medium text-gray-700 btn-secondary  cursor-pointer btn btn-xs btn-outline">
                {!! __('pagination.next') !!}
            </label>
        @else
            <label class=" items-center px-4  text-sm font-medium text-gray-500 btn-disabled cursor-not-allowed btn btn-xs btn-outline leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </label>
        @endif
    </nav>
@endif	
</div>