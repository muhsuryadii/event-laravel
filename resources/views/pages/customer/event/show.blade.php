<x-app-costumer-layout>
    <section>
        {{-- Hero Section --}}
        <div class="hero-section">
            <div class="image-wrapper relative	">
                <img src="{{ asset('/image/usni_bg.jpg') }}" loading='lazy' alt="usni_image_hero"
                    class="w-full  object-cover object-top " style="height: 400px">
                <div class="bg-overlay bg-gradient-to-b from-slate-500 to-gray-600 opacity-70"></div>

                <div class="bg-overlay search-bar-wrapper container my-10" style="max-width: inherit">
                    <div class="flex justify-start container mx-auto row p-0">
                        <div class="col-lg-3 !pl-0">
                            <img class=" mx-auto d-block shadow-md rounded-xl object-cover h-80"
                                src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                loading="lazy">
                        </div>
                        <div class="col-lg-9">
                            <h3 class="text-4xl  leading-normal text-white mt-4 line-clamp-2">
                                {{ $event->nama_event }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-info-wrapper container my-10">
            <div class=" row">
                <div class="col-lg-9">
                    <h2 class='font-semibold text-4xl text-slate-800'>Deskripsi Event</h2>

                    <p class="text-xl my-10">{{ $event->deskripsi_acara }}</p>
                </div>
                <div class="col-lg-3">
                    <div class="card-event-info-wrapper px-4 bg-white rounded-2xl border shadow-md border-slate-600">
                        <div class="wrapper py-3">
                            <div class="price-wrapper mb-3">
                                <h4 class="card-event-price text-xl font-semibold text-slate-500">Harga Event</h4>
                                @if ($event->harga_tiket == 0)
                                    <span class='text-slate-700 text-xl font-bold uppercase'>
                                        Gratis </span>
                                @else
                                    <span class='text-slate-700 text-xl  font-semibold'>Rp.
                                        {{ number_format($event->harga_tiket) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="date-wrapper mb-3">
                            <h4 class="card-event-date text-xl font-semibold text-slate-500">Tanggal</h4>
                            <span class='text-slate-700 text-xl  font-semibold'>
                                {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        <div class="date-wrapper mb-3">
                            <h4 class="card-event-date text-xl font-semibold text-slate-500">Jam</h4>
                            <span class='text-slate-700 text-xl  font-semibold'>
                                {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('h:i') }} WIB
                            </span>
                        </div>

                        <div class="date-wrapper mb-3">
                            <h4 class="card-event-date text-xl font-semibold text-slate-500">Lokasi</h4>
                            <span class='text-slate-700 text-xl  font-semibold'>
                                {{ $event->lokasi_acara }}
                            </span>
                        </div>


                        <form action='{{ route('checkout_store') }}' method="POST">
                            @csrf
                            @if (auth()->user())
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="harga_tiket" value="{{ $event->harga_tiket }}">
                            @endif

                            @if (!$transaction)
                                <button type="submit" class="btn btn-primary w-100 btn-simpan mb-4"> Pesan
                                    Tiket</button>
                            @endif
                        </form>

                        @if ($transaction)
                            <button type="submit" class="btn btn-success w-100 btn-simpan mb-4 disabled"> Tiket Sudah
                                Dibeli </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- End Hero Section --}}


    </section>

</x-app-costumer-layout>
