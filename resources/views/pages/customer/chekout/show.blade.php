<x-app-costumer-layout>
    <section class="container py-10">
        <h2 class="text-slate-700 font-bold">Detail Transaksi</h2>
        <div class="row mt-4">
            <div class="col-lg-8 ">
                <div class="summary-info-wrapper bg-white rounded-2xl border shadow-md border-slate-600 p-4">
                    <div class="title flex justify-between">
                        <h3 class="text-xl font-semibold text-slate-700 ">
                            No : {{ $transaksi->no_transaksi }}
                        </h3>
                        <span>
                            {{ Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d-F-Y H:i:s') }}
                        </span>
                    </div>
                    <div class="status">
                        <span class="text-slate-700 text-lg font-semibold">
                            Status Pembayaran :
                        </span>

                        @if ($transaksi->status_transaksi == 'not_paid')
                            <span class="text-red-500 text-lg font-semibold">
                                Belum Dibayar
                            </span>
                        @elseif($transaksi->status_transaksi == 'paid')
                            <span class="text-sky-600  text-lg font-semibold capitalize">
                                Pembayaran sedang diverifikasi oleh panitia
                            </span>
                        @elseif($transaksi->status_transaksi == 'verified')
                            <span class="text-green-600 text-lg font-semibold capitalize">
                                Pembayaran Telah diverifikasi
                            </span>
                        @else
                            <span class="text-red-600 text-lg font-semibold capitalize">
                                Verifikasi Pembayaran Ditolak
                            </span>
                            <p>
                                Pastikan anda telah melakukan pembayaran dengan benar, jika merasa butuh bantuan
                                silahkan hubungi panitia.
                            </p>
                        @endif

                        @if ($transaksi->waktu_pembayaran)
                            <p class="text-sm text-slate-500">
                                Waktu Pembayaran :
                                {{ Carbon\Carbon::parse($transaksi->waktu_pembayaran)->translatedFormat('d-F-Y H:i:s') }}

                                <span class='ml-2'>
                                    <a href="{{ asset('storage/' . $transaksi->bukti_transaksi) }}" target="_blank"
                                        class='no-underline'>
                                        Lihat Bukti Pembayaran <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </span>
                            </p>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if ($transaksi->status_transaksi != 'verified' && Auth::user())
                            <h4 class="text-lg font-semibold text-slate-700 ">
                                Upload Bukti Pembayaran
                            </h4>
                            <div class="mt-2">
                                <form action="{{ route('checkout_update', $transaksi->uuid) }}" method="POST"
                                    enctype="multipart/form-data" class='flex justify-between' id='formUploadBukti'>
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <input type="file" class="form-control-file form-control"
                                            id="bukti_pembayaran" required name="bukti_transaksi">
                                        <input type="hidden" name="no_transaksi"
                                            value="{{ $transaksi->no_transaksi }}">
                                        <input type="hidden" name="id_pembayaran" value="{{ $transaksi->id }}">
                                        <input type="hidden" name="old_bukti_transaksi"
                                            value="{{ $transaksi->bukti_transaksi }}">
                                    </div>
                                    <button type="submit" id='btnUploadBukti' class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="product-info mt-4 row">
                        <h4 class="text-slate-700 font-semibold mb-3">Informasi Event </h4>
                        <div class="col-lg-2 image-wrapper">
                            <img class="img-preview-list img-fluidmx-auto mx-auto d-block shadow-md rounded-md"
                                src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                loading="lazy">
                        </div>
                        <div class="col">
                            <p class="text-lg font-weight-bold mb-0 capitalize font-semibold">
                                <a href="{{ route('event_show', $event->uuid) }}" class="text-slate-700 no-underline">

                                    {{ $event->nama_event }}

                                </a>
                            </p>
                            <p class="text-secondary text-base font-semibold mt-2 mb-2">
                                <i
                                    class="fa-solid fa-calendar mr-3"></i>{{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-secondary text-base font-semibold">
                                <i class="fa-solid fa-location-pin fa-solid fa-calendar mr-3"></i>
                                {{ $event->lokasi_acara }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="summary-info-wrapper bg-white rounded-2xl border shadow-md border-slate-600 p-4">
                    <h3 class="text-xl font-bold text-slate-700 ">
                        Ringkasan Pesanan
                    </h3>
                    <div class="wrapper py-3">
                        <div class="price-wrapper mb-3">
                            <h4 class="card-event-price text-xl font-semibold text-slate-500">Harga Tiket</h4>
                            @if ($event->harga_tiket == 0)
                                <span class='text-slate-700 text-xl font-bold uppercase'>
                                    Gratis </span>
                            @else
                                <span class='text-slate-700 text-xl  font-semibold'>Rp.
                                    {{ number_format($event->harga_tiket) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="wrapper py-3 !border-t-2 border-slate-600">
                        <div class="price-wrapper mb-3">
                            <h4 class="card-event-price text-xl font-semibold text-slate-500">Total</h4>
                            <span class='text-slate-700 text-xl  font-semibold'>Rp.
                                {{ number_format($event->harga_tiket) }}</span>
                        </div>
                    </div>
                    @if ($transaksi->status_transaksi == 'not_paid')
                        <form action="{{ route('checkout_destroy', $transaksi->uuid) }}" method="POST"
                            class='flex justify-between' id='formBatalPesanan'>
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <input type="hidden" name="no_transaksi" value="{{ $transaksi->no_transaksi }}">
                                <input type="hidden" name="id_pembayaran" value="{{ $transaksi->id }}">
                            </div>
                            <button type="submit" id='btnBatalPesanan' class="btn btn-danger block w-full">Batalkan
                                Pemesanan</button>
                        </form>
                        <script>
                            const btnBatalPesanan = document.querySelector('#btnBatalPesanan');
                            btnBatalPesanan.addEventListener('click', function(e) {
                                e.preventDefault();
                                console.log('Testing');
                                Swal.fire({
                                    title: 'Batalkan Pemesanan Tiket ?',
                                    text: "Pemesanan tiket akan dihapus dari sistem",
                                    icon: 'warning',
                                    showDenyButton: true,
                                    confirmButtonText: 'Ya, Batalkan',
                                    denyButtonText: `Tidak`,
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        // Swal.fire('Event Tersimpan!', '', 'success');
                                        document.getElementById('formBatalPesanan').submit();
                                    }
                                })
                            })
                        </script>
                    @endif

                    {{-- @if ($event->status_transaksi == 'paid' && $event->is_certificate_ready == true)
                        <div class="wrapper ">
                            <button type="button" class="btn btn-primary w-100 btn-simpan ">Cetak
                                Sertifikat</button>
                        </div>
                    @elseif($event->status_transaksi == 'paid' && $event->is_certificate_ready == false)
                        <div class="wrapper ">
                            <button type="button" class="btn btn-primary w-100 btn-simpan disabled">Sertifikat
                                Belum Siap</button>
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </section>
    @push('js')
        {{-- Sweet alert --}}
        <script>
            const btnUploadBukti = document.querySelector('#btnUploadBukti');
            btnUploadBukti.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Testing');
                Swal.fire({
                    title: 'Apakah Sudah Benar ?',
                    text: "Apakah data yang diinput sudah sesuai",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Yakin',
                    denyButtonText: `Tidak`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        // Swal.fire('Event Tersimpan!', '', 'success');
                        document.getElementById('formUploadBukti').submit();
                    }
                })
            })
        </script>
    @endpush
</x-app-costumer-layout>
