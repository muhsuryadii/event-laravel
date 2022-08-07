@if ($paginator->hasPages())
  <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <div class="flex flex-1 justify-between sm:hidden">
      @if ($paginator->onFirstPage())
        <span
          class="relative inline-flex cursor-default items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
          {!! __('pagination.previous') !!}
        </span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}"
          class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700">
          {!! __('pagination.previous') !!}
        </a>
      @endif

      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
          class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700">
          {!! __('pagination.next') !!}
        </a>
      @else
        <span
          class="relative ml-3 inline-flex cursor-default items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
          {!! __('pagination.next') !!}
        </span>
      @endif
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm leading-5 text-gray-700">
          {!! __('Showing') !!}
          @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
          @else
            {{ $paginator->count() }}
          @endif
          {!! __('of') !!}
          <span class="font-medium">{{ $paginator->total() }}</span>
          {!! __('results') !!}
        </p>
      </div>

      <div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
              <span
                class="disabled relative inline-flex h-full w-[39px] cursor-default items-center rounded-l-md border border-gray-300 bg-slate-200 px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                aria-hidden="true">
                <i class="fa-solid fa-chevron-left"></i>
              </span>
            </span>
          @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
              class="relative block h-full w-[39px] items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-500"
              aria-label="{{ __('pagination.previous') }}">

              <i class="fa-solid fa-chevron-left"></i>

            </a>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
              <span aria-disabled="true">
                <span
                  class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-slate-200 px-4 py-2 text-sm font-medium leading-5 text-gray-700">{{ $element }}</span>
              </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                  <span aria-current="page">
                    <span
                      class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-slate-200 px-4 py-2 text-sm font-medium leading-5 text-gray-500">{{ $page }}</span>
                  </span>
                @else
                  <a href="{{ $url }}"
                    class="relative -ml-px inline-flex items-center border border-gray-300 bg-[#fff] px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:bg-slate-200 hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700"
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                    {{ $page }}
                  </a>
                @endif
              @endforeach
            @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
              class="relative -ml-px block h-full w-[39px] items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-500"
              aria-label="{{ __('pagination.next') }}">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
              <span
                class="relative -ml-px inline-flex h-full w-[39px] cursor-default items-center rounded-r-md border border-gray-300 bg-slate-200 px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                aria-hidden="true">
                <i class="fa-solid fa-chevron-right"></i>

              </span>
            </span>
          @endif
        </span>
      </div>
    </div>
  </nav>
@endif
