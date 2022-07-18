<x-app-costumer-layout>
  {{-- {{ dd($events) }} --}}
  {{-- Hero Section --}}
  <section>
    <div class="hero-section">
      <div class="image-wrapper relative">
        <img src="{{ asset('/image/usni_bg.jpg') }}" loading="lazy" alt="usni_image_hero"
          class="h-[300px] w-full object-cover object-top">
        <div class="bg-overlay bg-gradient-to-b from-slate-500 to-gray-600 opacity-60"></div>
        <div class="hero-top search-bar-wrapper container flex h-full flex-col flex-wrap justify-center"
          style="max-width: inherit">
          <div class="text">
            <p class="text-center font-sans text-2xl font-semibold text-white">
              Temukan Acara Dan Kegiatan Event Di Website Event Usni
            </p>
          </div>
          <div class="flex justify-center">
            <div class="mb-3 w-full md:w-[400px]">
              <form action="" method="POST">
                @csrf
                <div class="input-group relative mb-4 flex w-full flex-wrap items-stretch">


                  <input type="search"
                    class="form-control relative mr-3 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  <button
                    class="duration-150ss flex items-center rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg"
                    type="button" id="button-addon2">
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
            <a href="event/{{ $event->uuid }}"
              class="events-card w-full p-2 text-slate-600 no-underline md:w-1/2 lg:w-1/5">
              <div
                class="content-wrapper h-full overflow-hidden rounded-3xl border-2 border-gray-200 bg-white shadow-md transition-all duration-200 ease-in-out hover:shadow-lg">

                <div class="image-wrapper event-image-wrapper">
                  <img class="d-block mx-auto h-full w-full object-cover"
                    src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                    loading="lazy">
                </div>

                <div class="event-info-wrapper flex flex-col flex-wrap justify-between px-3 py-4">
                  <div class="event_info w-full">
                    <div class="tanggal-wrapper">
                      <i class="fa-regular fa-calendar text-secondary mr-1"></i>
                      <span class="text-secondary font-weight-bold text-xs">
                        {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                      </span>
                    </div>
                    <div class="panitia">
                      <i class="fa-solid fa-image-portrait text-secondary mr-1"></i>
                      <span class="text-secondary font-weight-bold text-xs">
                        {{ $event->nama_panitia }}
                      </span>
                    </div>

                    <h3 class="line-clamp-3 mt-2 text-base font-semibold" title="{{ $event->nama_event }}">
                      {{ $event->nama_event }}
                    </h3>
                  </div>

                  <div class="event_price">

                    @if ($event->harga_tiket == 0)
                      <span class='text-base font-bold uppercase text-slate-700'>
                        Gratis </span>
                    @else
                      <span class='text-base font-semibold text-slate-700'>Rp.
                        {{ number_format($event->harga_tiket) }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </a>
          @endforeach

        </div>
      </div>
    </div>
  </section>

</x-app-costumer-layout>
