<x-app-costumer-layout>

    <section class="container py-10">
        <h2 class="text-slate-700 font-bold">Detail Tiket</h2>
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
                        @elseif($transaksi->status_transaksi == 'pending')
                            <span class="text-sky-600  text-lg font-semibold capitalize">
                                pembayaran sedang diperiksa
                            </span>
                        @else
                            <span class="text-green-600 text-lg font-semibold">
                                Lunas
                            </span>
                        @endif
                        <p class="text-sm text-slate-500">
                            Waktu Pembayaran :
                            {{ Carbon\Carbon::parse($transaksi->waktu_pembayaran)->translatedFormat('d-F-Y H:i:s') }}

                            <span class='ml-2'>
                                <a href="{{ asset('storage/' . $transaksi->bukti_transaksi) }}" target="_blank">
                                    Lihat Bukti Pembayaran
                                </a>
                            </span>
                        </p>
                    </div>

                    <div class="mt-4">
                        @if ($transaksi->status_transaksi == 'not_paid')
                            <h4 class="text-lg font-semibold text-slate-700 ">
                                Upload Bukti Pembayaran
                            </h4>
                            <div class="mt-2">
                                <form action="{{ route('checkout_update', $transaksi->no_transaksi) }}" method="POST"
                                    enctype="multipart/form-data" class='flex justify-between'>
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <input type="file" class="form-control-file form-control"
                                            id="bukti_pembayaran" name="bukti_transaksi">
                                        <input type="hidden" name="no_transaksi"
                                            value="{{ $transaksi->no_transaksi }}">
                                        <input type="hidden" name="id_pembayaran" value="{{ $transaksi->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
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
                                {{ $event->nama_event }}
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

                    @if ($event->status_transaksi == 'paid' && $event->is_certificate_ready == true)
                        <div class="wrapper ">
                            <button type="button" class="btn btn-primary w-100 btn-simpan ">Cetak
                                Sertifikat</button>
                        </div>
                    @elseif($event->status_transaksi == 'paid' && $event->is_certificate_ready == false)
                        <div class="wrapper ">
                            <button type="button" class="btn btn-primary w-100 btn-simpan disabled">Sertifikat
                                Belum Siap</button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

</x-app-costumer-layout>
