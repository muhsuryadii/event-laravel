<x-app-costumer-layout>

    <section>

        <div class='mt-16'>
            <div class="container">
                <h2 class="text-2xl font-bold text-center uppercase text-slate-700">
                    List Event
                </h2>

                <div class="flex flex-wrap flex-row justify-center pb-5 pt-3">
                    @foreach ($events as $event)
                        <a href="event/{{ $event->slug }}"
                            class="events-card w-full md:w-1/2 lg:w-1/5 p-2 mt-3 text-slate-600 no-underline ">
                            <div
                                class="bg-white border-2 border-gray-200 rounded-3xl overflow-hidden  h-full content-wrapper shadow-md hover:shadow-lg 
                            transition-all duration-200 ease-in-out">

                                <div class="image-wrapper event-image-wrapper">
                                    <img class="mx-auto d-block  w-full h-full object-cover "
                                        src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                        loading="lazy">
                                </div>

                                <div class="px-3 py-4  flex flex-col flex-wrap justify-between event-info-wrapper">
                                    <div class="event_info w-full">
                                        <i class="fa-regular fa-calendar mr-1 text-secondary"></i>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                                        </span>
                                        <h3 class="text-base  font-semibold mt-2 line-clamp-3"
                                            title="{{ $event->nama_event }}">
                                            {{ $event->nama_event }}
                                        </h3>
                                    </div>

                                    <div class="event_price">

                                        @if ($event->harga_tiket == 0)
                                            <span class='text-slate-700 text-base font-bold uppercase'>
                                                Gratis </span>
                                        @else
                                            <span class='text-slate-700 text-base  font-semibold'>Rp.
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
