<x-app-costumer-layout>


  <section class="container">
    <div class='mt-16'>
      <form action="{{ route('event_search') }}" method="get">
        <div class="input-group relative mb-4 flex w-full flex-wrap items-stretch">
          <input type="search"
            class="form-control relative mr-3 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none"
            placeholder="Cari Nama Event" aria-label="Search" aria-describedby="button-addon2" name="search">


          <button
            class="duration-150ss flex items-center rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg"
            type="submit" id="button-addon2">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>

        </div>
      </form>
      @if ($request && count($events) > 0)
        <h3 class='font-semibold text-slate-500'>Hasil pencarian : {{ $request }} </h3>
      @endif

      @if (count($events) > 0)
        <div class="container">
          <div class="flex flex-row flex-wrap pb-5 pt-3">
            @foreach ($events as $event)
              @include('pages.customer.event.eventCard')
            @endforeach

          </div>
        </div>
      @else
        <h3 class='font-semibold text-slate-500'>Tidak ditemukan event dengan kata kunci : {{ $request }} </h3>
      @endif

    </div>

  </section>

</x-app-costumer-layout>
