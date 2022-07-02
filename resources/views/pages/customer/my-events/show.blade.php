<x-app-costumer-layout>
    {{-- {{ dd($event) }} --}}
    <section class="container py-10">
        <div class="card-list-wrapper mx-auto lg:max-w-[700px]">
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
                @if (now() >= $event->waktu_acara)
                    <form action="{{ route('my-events_absent', $event->uuid) }}">

                    </form>
                    <button type="submit" id='btnBatalPesanan' class="btn btn-primary !rounded-md block w-full">Absen
                        Event</button>
                @else
                    <div class="container">
                        <div class="element text-center font-mono">
                            <h3>Event Akan Berjalan pada : </h3>
                            <p id="demo">Loading...</p>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @push('js')
        <script>
            // Set the date we're counting down to
            const countDownDate = new Date("{{ $event->waktu_acara }}").getTime();

            // Update the count down every 1 second
            const x = setInterval(function() {

                // Get todays date and time
                const now = new Date().getTime();

                // Find the distance between now and the count down date
                const distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam  " +
                    minutes + " Menit dan " + seconds + " detik!";

                // If the count down is finished, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
    @endpush
</x-app-costumer-layout>
