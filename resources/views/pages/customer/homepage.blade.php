<x-app-costumer-layout>
  {{-- {{ dd($events) }} --}}
  {{-- Hero Section --}}
  <section>
    <div class="hero-section">
      <div class="image-wrapper relative">
        <img src="{{ asset('/image/usni_bg.jpg') }}" loading="lazy" alt="usni_image_hero"
          class="h-[300px] w-full object-cover object-top">
        <div class="bg-overlay bg-gradient-to-b from-slate-600 to-gray-700 opacity-60"></div>
        <div class="hero-top search-bar-wrapper container flex h-full flex-col flex-wrap justify-center"
          style="max-width: inherit">
          <div class="text">
            <p class="text-center font-sans text-2xl font-semibold text-white">
              Temukan Acara Dan Kegiatan Event Di Website Event Usni
            </p>
          </div>
          <div class="flex justify-center">
            <div class="mb-3 w-full md:w-[400px]">
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
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- Rekomendasi Event --}}
    <div class='mt-16'>
      <div class="container">
        <div class="title-wrapper flex justify-between">
          <h2 class="text-2xl font-bold text-slate-700">
            Event Terdekat
          </h2>
          <a href="{{ route('event_index') }}" class='under items-center text-base font-semibold'>
            Lihat Semua
          </a>
        </div>


        <div class="flex flex-row flex-wrap justify-center pb-5 pt-3">
          @foreach ($events as $event)
          
            @include('pages.customer.event.eventCard')
          @endforeach

        </div>
      </div>
    </div>
  </section>

</x-app-costumer-layout>
