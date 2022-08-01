<x-app-costumer-layout>
  {{-- {{ dd($humasList) }} --}}
  <section>
    {{-- Hero Section --}}
    <div class="hero-section">
      <div class="image-wrapper relative">
        <img src="{{ asset('/image/usni_bg.jpg') }}" loading='lazy' alt="usni_image_hero"
          class="h-[500px] w-full object-cover object-top lg:h-[400px]">
        <div class="bg-overlay bg-gradient-to-b from-slate-700 to-gray-800 opacity-80"></div>

        <div class="hero-top search-bar-wrapper container my-10" style="max-width: inherit">
          <div class="row container mx-auto flex justify-start p-0">
            <div class="col-lg-3 col-6 mx-auto !pl-0 lg:mx-0">
              <img class="d-block mx-auto h-52 rounded-xl object-cover shadow-md lg:h-80"
                src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                loading="lazy">
            </div>
            <div class="col-lg-9">
              <h3 class="line-clamp-3 mt-4 text-center text-3xl leading-normal text-white lg:text-left lg:text-4xl">
                {{ $event->nama_event }}
              </h3>
              <h4 class="mt-3 text-2xl leading-normal text-white lg:text-3xl">Oleh :
                <a href="/event-by/{{ $panitia->uuid }}" class="text-white">
                  {{ $panitia->nama_user }}
                </a>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="event-info-wrapper container my-10">
      <div class="row">
        <div class="col-lg-9">
          <h2 class='text-4xl font-semibold text-slate-800'>Deskripsi Event</h2>

          <p class="my-10 text-xl">{!! $event->deskripsi_acara !!}</p>
        </div>
        <div class="col-lg-3">
          <div class="card-event-info-wrapper rounded-2xl border border-slate-600 bg-white px-4 shadow-md">
            <div class="wrapper pt-3">
              <div class="price-wrapper mb-3">
                <h4 class="card-event-price text-xl font-semibold text-slate-500">Harga Event</h4>
                @if ($event->harga_tiket == 0)
                  <span class='text-xl font-bold uppercase text-slate-700'>
                    Gratis </span>
                @else
                  <span class='text-xl font-semibold text-slate-700'>Rp.
                    {{ number_format($event->harga_tiket) }}</span>
                @endif
              </div>
            </div>

            <div class="date-wrapper mb-3">
              <h4 class="card-event-date text-xl font-semibold text-slate-500">Sisa Kuota Tiket</h4>
              <span class='text-xl font-semibold text-slate-700'>
                {{ $event->kuota_tiket }}
              </span>
            </div>
            <div class="date-wrapper mb-3">
              <h4 class="card-event-date text-xl font-semibold text-slate-500">Tanggal</h4>
              <span class='text-xl font-semibold text-slate-700'>
                {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
              </span>
            </div>
            <div class="date-wrapper mb-3">
              <h4 class="card-event-date text-xl font-semibold text-slate-500">Jam</h4>
              <span class='text-xl font-semibold text-slate-700'>
                {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('h:i') }} WIB
              </span>
            </div>

            <div class="date-wrapper mb-3">
              <h4 class="card-event-date text-xl font-semibold text-slate-500">Lokasi</h4>
              <span class='text-xl font-semibold text-slate-700'>
                {{ $event->lokasi_acara }}
              </span>
            </div>



            <form action='{{ route('checkout_store') }}' id='formEventStore' method="POST">
              @csrf

              @if (auth()->user())
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="harga_tiket" value="{{ $event->harga_tiket }}">
              @endif

              @if (!$transaction)
                @if ($event->kuota_tiket != 0)
                  <button type="submit" class="btn btn-primary w-100 btn-simpan mb-4" id='btnPesanTiket'
                    {{ auth()->user() ? (auth()->user()->role != 'PESERTA' ? 'hidden' : ' ') : ' ' }}>Pesan
                    Tiket</button>
                @else
                  <span class="btn btn-danger w-100 btn-simpan disabled mb-4" id='btnPesanTiket'>
                    Tiket Sudah Habis</span>
                @endif
              @endif

              @if ($transaction)
                @if ($transaction->status_transaksi == 'not_paid')
                  <a href="{{ route('checkout_show', $transaction->uuid) }}"
                    class="btn btn-primary w-100 btn-simpan mb-4">Bayar Tiket</a>
                @else
                  <button type="submit" class="btn btn-success w-100 btn-simpan disabled mb-4">
                    Tiket Sudah Dibeli </button>
                @endif
              @endif
            </form>


          </div>

          @if ($humasList && count($humasList) > 0)
            <div class="card-event-info-wrapper mt-3 rounded-2xl border border-slate-600 bg-white px-4 shadow-md">
              <div class="wrapper pt-3">
                <div class="price-wrapper mb-3">
                  <h4 class="card-event-price text-xl font-semibold text-slate-500">Kontak Humas</h4>
                </div>
              </div>
              @foreach ($humasList as $humas)
                <div class="wrapper pt-2">
                  <a href="https://wa.me/{{ $humas->no_wa }}" target="_blank" rel='noopener noreferrer'
                    class="btn btn-success w-100 btn-simpan mb-4 !bg-emerald-500">
                    <i class="fa-brands fa-whatsapp mr-2"></i>
                    {{ $humas->nama }}
                  </a>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>


    {{-- End Hero Section --}}
  </section>

  @push('js')
    {{-- Sweet alert --}}
    @if (auth()->user() && auth()->user()->role == 'PESERTA')
      <script>
        const btnPesan = document.querySelector('#btnPesanTiket');
        const html = `<p class='font-semibold'>Syarat&Ketentuan :  </p>
            <ol class="p-0">
              <li class="pb-2">1. Setelah peserta melakukan pembayaran maka apabila peserta tidak ikut acara uang tidak kembali.</li>
              <li>2. Peserta harus melakukan absensi di sistem sebagai syarat mendapatkan sertifikat</li>
            </ol>`;

        btnPesan.addEventListener('click', function(e) {
          e.preventDefault();
          console.log('Testing');
          Swal.fire({
            title: 'Apakah anda yakin ?',
            html: html,
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Yakin',
            denyButtonText: `Tidak`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              // Swal.fire('Event Tersimpan!', '', 'success');
              document.getElementById('formEventStore').submit();
            }
          })
        })
      </script>
    @endif
  @endpush

</x-app-costumer-layout>
