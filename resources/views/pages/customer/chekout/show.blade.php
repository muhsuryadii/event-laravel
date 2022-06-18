<x-app-costumer-layout>

    <section class="container my-10">
        <h2>Detail Transaksi</h2>
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
                            Status Pesanan :
                        </span>

                        @if ($transaksi->status_transaksi == 'not_paid')
                            <span class="text-red-500 text-lg font-semibold">
                                Belum Dibayar
                            </span>
                        @elseif($transaksi->status_transaksi == 'paid')
                            <span class="text-slate-600 text-lg font-semibold">
                                Pending
                            </span>
                        @else
                            <span class="text-green-600 text-lg font-semibold">
                                Lunas
                            </span>
                        @endif

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
                </div>
            </div>
        </div>
    </section>

</x-app-costumer-layout>
