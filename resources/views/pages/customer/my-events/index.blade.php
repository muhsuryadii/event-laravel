<x-app-costumer-layout>
  <section class="container py-10">
    <div class='col-12'>
      <div class="container">
        @if (count($events) == 0)
          <div class="mt-3 flex justify-center text-slate-600">
            <div class="warning-wrapper w-[500px]">
              <h4 class="alert-heading text-5xl">Oops!</h4>
              <p class="mt-3 text-4xl leading-snug">
                Belum ada events yang dibeli atau diverifikasi.
              </p>
            </div>
          </div>
        @else
          <div class="card-list-wrapper mx-auto lg:max-w-[700px]">

            <h2 class="mb-4 text-2xl font-bold uppercase text-slate-600">
              My Events
            </h2>
            @foreach ($events as $event)
              <a href="{{ route('my-events_show', $event->event_id) }}"
                class="text-slate-600 no-underline hover:text-slate-600">

                <div
                  class="card-wrapper mb-3 flex rounded-2xl border border-slate-600 bg-white p-4 shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                  <div class="image-wrapper lg:mr-5 lg:w-full lg:max-w-[30%]">
                    <img class="block rounded-2xl object-cover lg:h-[200px]"
                      src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                      loading="lazy" decoding="async">
                  </div>

                  <div class="event-info w-full">
                    <div class="title-wrapper">
                      <h2 class='line-clamp-2 text-2xl' title="{{ $event->nama_event }}">
                        {{ $event->nama_event }}</h2>
                    </div>

                    <div class="event-content-wrapper">
                      <p class="text-secondary mt-2 mb-2 text-base font-semibold">
                        <i
                          class="fa-solid fa-calendar mr-3"></i>{{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                      </p>
                      <p class="text-secondary mt-2 mb-2 text-base font-semibold">
                        <i class="fa-solid fa-location-pin mr-3"></i>
                        {{ $event->lokasi_acara }}
                      </p>
                      <p class="text-secondary mt-2 mb-2 text-base font-semibold">
                        <i class="fa-solid fa-check mr-3"></i>

                        @if ($event->status_absen)
                          <span class="text-green-500">
                            Sudah Absen
                          </span>
                        @else
                          <span class="text-red-500">
                            Belum Absen
                          </span>
                        @endif
                      </p>
                      <p class="text-secondary mt-2 mb-2 text-base font-semibold">
                        <i class="fa-solid fa-certificate mr-3"></i>

                        @if ($event->is_certificate_ready)
                          <span class="text-green-500">
                            E-Sertifikat Sudah Tersedia
                          </span>
                        @else
                          <span class="text-red-500">
                            E-Sertifikat Belum Tersedia
                          </span>
                        @endif
                      </p>

                    </div>


                  </div>

                </div>
              </a>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>
</x-app-costumer-layout>
