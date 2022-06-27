<x-app-costumer-layout>

    <section class="container py-10">
        <div class="card-list-wrapper mx-auto lg:max-w-[700px]  ">
            <div
                class="p-4 mb-3 card-wrapper bg-white rounded-2xl border shadow-[0_3px_10px_rgb(0,0,0,0.2)] border-slate-600 flex">
                <div class="image-wrapper  lg:max-w-[30%] lg:w-full lg:mr-5">
                    <img class="block rounded-2xl lg:h-[200px]  object-cover "
                        src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                        loading="lazy" decoding="async">
                </div>

                <div class="event-info w-full">
                    <div class="title-wrapper">
                        <h2 class='line-clamp-2 text-2xl' title="{{ $event->nama_event }}">
                            {{ $event->nama_event }}</h2>
                    </div>

                    <div class="event-content-wrapper">
                        <p class="text-secondary text-base font-semibold mt-2 mb-2">
                            <i
                                class="fa-solid fa-calendar mr-3"></i>{{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-secondary text-base font-semibold mt-2 mb-2">
                            <i class="fa-solid fa-location-pin  mr-3"></i>
                            {{ $event->lokasi_acara }}
                        </p>
                        <p class="text-secondary text-base font-semibold mt-2 mb-2">
                            <i class="fa-solid fa-certificate  mr-3"></i>

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
            <div class="summary-info-wrapper bg-white rounded-2xl border shadow-md border-slate-600 p-4">
                <button type="submit" id='btnBatalPesanan' class="btn btn-primary !rounded-md block w-full">Absen
                    Event</button>
            </div>
        </div>

    </section>
</x-app-costumer-layout>
