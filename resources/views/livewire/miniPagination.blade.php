<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 ">
                <span>
                    @if ($paginator->onFirstPage())
                        <button class="btn btn-outline btn-info btn-xs btn-disabled ">
                            {!! __('pagination.previous') !!}
                        </button>
                    @else
                        <span wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage.before" class="btn btn-outline btn-info btn-xs ">
                            {!! __('pagination.previous') !!}
                        </span>
                    @endif
                </span>
                <span>
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage.before" class="btn btn-outline btn-info btn-xs">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <button class="btn btn-outline btn-info btn-xs btn-disabled ">
                            {!! __('pagination.next') !!}
                        </button>
                    @endif
                </span>
            </div>

           
        </nav>
    @endif
</div>