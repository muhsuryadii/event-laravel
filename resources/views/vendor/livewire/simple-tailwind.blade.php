<div>
  @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
      <span>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span
            class="relative inline-flex cursor-default select-none items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
            {!! __('pagination.previous') !!}

          </span>
        @else
          @if (method_exists($paginator, 'getCursorName'))
            <button dusk="previousPage"
              wire:click="setPage('{{ $paginator->previousCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
              wire:loading.attr="disabled"
              class="focus:shadow-outline-blue relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700">
              {!! __('pagination.previous') !!}
              {{-- <i class="fa-solid fa-chevron-left"></i> --}}
            </button>
          @else
            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
              dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
              class="focus:shadow-outline-blue relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700">
              {!! __('pagination.previous') !!}
            </button>
          @endif
        @endif
      </span>

      <span>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          @if (method_exists($paginator, 'getCursorName'))
            <button dusk="nextPage"
              wire:click="setPage('{{ $paginator->nextCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
              wire:loading.attr="disabled"
              class="focus:shadow-outline-blue relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700">
              {!! __('pagination.next') !!}
            </button>
          @else
            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
              dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
              class="focus:shadow-outline-blue relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700">
              {!! __('pagination.next') !!}
            </button>
          @endif
        @else
          <span
            class="relative inline-flex cursor-default select-none items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
            {!! __('pagination.next') !!}
          </span>
        @endif
      </span>
    </nav>
  @endif
</div>
