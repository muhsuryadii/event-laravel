<x-app-costumer-layout>
    {{-- {{ dd($events) }} --}}
    {{-- Hero Section --}}
    <section>
        <div class="hero-section">
            <div class="image-wrapper relative	">
                <img src="{{ asset('/image/usni_bg.jpg') }}" loading="lazy" alt="usni_image_hero"
                    class="w-full  object-cover object-top h-[300px] ">
                <div class="bg-overlay bg-gradient-to-b from-slate-500 to-gray-600 opacity-60"></div>
                <div class="bg-overlay search-bar-wrapper container h-full flex flex-wrap flex-col justify-center"
                    style="max-width: inherit">
                    <div class="text">
                        <p class="text-center font-semibold text-2xl font-sans text-white">
                            Temukan Acara Dan Kegiatan Event Di Website Event Usni
                        </p>
                    </div>
                    <div class="flex justify-center ">
                        <div class="mb-3 md:w-[400px] w-full">
                            <form action="" method="POST">
                                @csrf
                                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">


                                    <input type="search"
                                        class="form-control mr-3 relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                    <button
                                        class="  px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150ss ease-in-out flex items-center"
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
                    <h2 class="text-2xl font-bold  text-slate-700">
                        Event Terdekat
                    </h2>
                    <a href="{{ route('event_index') }}" class='text-base under font-semibold items-center'>
                        Lihat Semua
                    </a>
                </div>


                <div class="flex flex-wrap flex-row justify-center pb-5 pt-3">
                    @foreach ($events as $event)
                        <a href="event/{{ $event->uuid }}"
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
