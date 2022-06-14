<x-app-costumer-layout>
    {{-- {{ dd($events) }} --}}
    {{-- Hero Section --}}
    <section>
        <div class="image-wrapper relative	h-[300px]">
            {{-- <img src="{{ asset('/image/usni_bg.jpg') }}" alt="usni_image_hero"
                class="w-full  object-cover object-top  "> --}}
            <div class=" bg-overlay bg-gradient-to-b from-slate-400 to-gray-500 opacity-50"></div>
            <div class="search-form  h-full" style="
                background-image: url({{ asset('/image/usni_bg.jpg') }})
            ">
                <div class="search-bar-wrapper container h-full flex flex-wrap flex-col justify-center">
                    <div class="text">
                        <p class="text-center font-semibold text-xl font-sans text-white">
                            Temukan Acara Dan Kegiatan Event Di Website Event Usni
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                                <input type="search"
                                    class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <button
                                    class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                                    type="button" id="button-addon2">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                                        class="w-4" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>

    {{-- Rekomendasi Event --}}

    <section class='mt-16'>
        <div class="container">
            <div class="title-wrapper flex justify-between">
                <h2 class="text-2xl font-bold  text-slate-700">
                    Rekomendasi Event
                </h2>
                <a href="/event" class='text-base under font-semibold items-center'>
                    Lihat Semua
                </a>
            </div>


            <div class="flex flex-wrap flex-row justify-center pb-5 pt-3">
                @foreach ($events as $event)
                    <a href="event/{{ $event->slug }}"
                        class="events-card w-full md:w-1/2 lg:w-1/5 p-2 text-slate-600 no-underline ">
                        <div
                            class="bg-white border-2 border-gray-200 rounded-3xl overflow-hidden  h-full content-wrapper shadow-md hover:shadow-lg 
                            transition-all duration-200 ease-in-out">

                            <div class="image-wrapper event-image-wrapper">
                                <img class="mx-auto d-block  w-full h-full object-cover "
                                    src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                    loading="lazy">
                            </div>

                            <div class="px-3 py-4  flex flex-col flex-wrap justify-between event-info-wrapper">
                                <div class="event_info h-[100px] w-full">
                                    <i class="fa-regular fa-calendar mr-1 text-secondary"></i>
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                                    </span>
                                    <h3
                                        class="text-base text-justify font-semibold mt-2 block  overflow-ellipsis whitespace-nowrap overflow-hidden">
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
    </section>


</x-app-costumer-layout>
