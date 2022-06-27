<x-app-costumer-layout>
    <section class="container py-10">
        <div class='col-12'>
            <div class="container">
                @if (count($events) == 0)
                    <div class="text-slate-600 mt-3 flex justify-center ">
                        <div class="warning-wrapper w-[500px]">
                            <h4 class="alert-heading text-5xl">Oops!</h4>
                            <p class="text-4xl mt-3 leading-snug">
                                Belum ada events yang dibeli atau diverifikasi.
                            </p>
                        </div>
                    </div>
                @else
                    <div class="card-list-wrapper mx-auto lg:max-w-[700px]  ">

                        <h2 class="text-2xl font-bold mb-4 uppercase text-slate-600">
                            My Events
                        </h2>
                        @foreach ($events as $event)
                            <a href="{{ route('my-events_show', $event->uuid) }}"
                                class="text-slate-600 no-underline hover:text-slate-600">

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
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-costumer-layout>
