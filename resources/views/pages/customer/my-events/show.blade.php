<x-app-costumer-layout>
  {{-- {{ dd(Carbon\Carbon::parse($event->waktu_acara)->addHours(5)->translatedFormat('d F Y H:i')) }} --}}
  <section class="container py-10">
    <div class="card-list-wrapper mx-auto lg:max-w-[700px]">
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

      {{-- For Production --}}
      @if (now() <= $event->waktu_acara)
        <div class="summary-info-wrapper mt-4 rounded-2xl border border-slate-600 bg-white p-3 shadow-md">

          <div class="container">
            <div class="element text-center font-mono">
              <h3>Event Akan Berjalan pada : </h3>
              <p id="demo" class='text-lg'>Loading...</p>

            </div>
          </div>
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
                  location.reload();
                }
              }, 1000);
            </script>
          @endpush
        </div>
      @else
        <div class="summary-info-wrapper rounded-2xl border border-slate-600 bg-white p-4 shadow-md">
          @if ($event->waktu_acara <= Carbon\Carbon::parse($event->waktu_acara)->addHours(5))
            @if ($laporan->status_absen == 0)
              <form action="{{ route('my_events_absent', $event->uuid_event) }}" method="POST">
                @csrf
                <input type="hidden" name="id_event" value="{{ $event->id_event }}">
                <input type="hidden" name="id_transaksi" value="{{ $event->id_transaksi }}">
                <input type="hidden" name="id_peserta" value="{{ $event->id_peserta }}">
                <input type="hidden" name="id_laporan" value="{{ $laporan->id }}">

                <button type="submit" id='btn_absen' class="btn btn-primary block w-full !rounded-md">Absen
                  Event</button>
              </form>
            @else
              <button type="button" disabled id='btn_absen' class="btn btn-success block w-full !rounded-md">Anda
                Sudah Absen</button>
            @endif
          @else
            <button type="button" disabled id='btn_absen' class="btn btn-danger block w-full !rounded-md">Batas waktu
              absen telah habis</button>
          @endif

          @if ($event->is_certificate_ready)
            @if ($laporan->status_absen == 0)
              <button type="button" disabled id='btn_absen' class="btn btn-success mt-2 block w-full !rounded-md">Anda
                Belum Absen</button>
            @else
              <a href="{{ route('my_events_certificate', $event->uuid_event) }}" target="_blank" id='btn_absen'
                class="btn btn-primary mt-4 block w-full !rounded-md">Download
                Sertifikat</a>
            @endif
          @endif
        </div>
      @endif
    </div>
  </section>


</x-app-costumer-layout>
