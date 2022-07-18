<x-app-costumer-layout>

  <section>

    <div class='mt-16'>
      <div class="container">
        <h2 class="text-center text-2xl font-bold uppercase text-slate-700">
          List Event
        </h2>
        {{-- {{ dd($events) }} --}}
        <div class="flex flex-row flex-wrap pb-5 pt-3">
          @foreach ($events as $event)
            <a href="event/{{ $event->uuid }}"
              class="events-card mt-3 w-full p-2 text-slate-600 no-underline md:w-1/2 lg:w-1/5">
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
