<x-app-costumer-layout>
    {{-- {{ dd($transaksi) }} --}}
    <section class="container py-10">

        <div class="card-list-wrapper mx-auto lg:max-w-[700px]  ">

            @if (count($transaksi) == 0)
                <div class="text-slate-600 mt-3 flex justify-center ">
                    <div class="warning-wrapper w-[500px]">
                        <h4 class="alert-heading text-5xl">Oops!</h4>
                        <p class="text-4xl mt-3 leading-snug">
                            Belum ada Transaksi yang pernah dilakukan.
                        </p>
                    </div>
                </div>
            @else
                <h2 class="text-2xl font-bold mb-4 uppercase text-slate-600">
                    List Transaksi
                </h2>
                @foreach ($transaksi as $trans)
                    <a href="{{ route('checkout_show', $trans->uuid) }}"
                        class="text-slate-600 no-underline hover:text-slate-600">

                        <div
                            class="p-4 mb-3 card-wrapper bg-white rounded-2xl border shadow-[0_3px_10px_rgb(0,0,0,0.2)] border-slate-60 flex ">
                            <div class="image-wrapper  lg:max-w-[30%] lg:w-full lg:mr-5">
                                <img class="block rounded-2xl lg:h-[200px]  object-cover "
                                    src="{{ $trans->famplet_acara_path != null ? asset('storage/' . $trans->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                    loading="lazy" decoding="async">
                            </div>

                            <div class="event-info w-full">
                                <div class="title-wrapper">
                                    <h2 class='line-clamp-2 text-2xl' title="{{ $trans->nama_event }}">
                                        {{ $trans->nama_event }}</h2>
                                </div>

                                <div class="transaksi-info-wrapper mt-3 flex">
                                    <div class="title-transaksi-info w-[50%] mr-3">
                                        <h6 class="mb-[8px] ">Status</h6>
                                        <h6 class="mb-[8px] ">No. Invoice</h6>
                                        <h6 class="mb-[8px] ">Tanggal Transaksi</h6>
                                        <h6 class="mb-[8px] ">Tanggal Pembayaran</h6>
                                        <h6 class="mb-[8px] ">Jumlah Pembayaran</h6>
                                    </div>
                                    <div class="content-transaksi-info w-[50%]">

                                        @if ($trans->status_transaksi == 'not_paid')
                                            <p class="mb-[3px] font-semibold text-warning">
                                                <i class="fa-solid fa-circle-exclamation  mr-1"></i>Belum Dibayar
                                            </p>
                                        @elseif($trans->status_transaksi == 'paid')
                                            <p class="mb-[3px] font-semibold text-sky-500">
                                                <i class="fa-solid fa-circle-info  mr-1"></i>
                                                Diproses
                                            </p>
                                        @elseif($trans->status_transaksi == 'verified')
                                            <p class="mb-[3px] font-semibold text-green-500">
                                                <i class="fa-solid fa-check-circle mr-1"></i>
                                                Sukses
                                            </p>
                                        @else
                                            <p class="mb-[3px] font-semibold text-red-500">
                                                <i class="fa-solid fa-circle-xmark  mr-1"></i>
                                                Ditolak
                                            </p>
                                        @endif



                                        <p class="mb-[3px] ">{{ $trans->no_transaksi }}</p>
                                        <p class="mb-[3px] ">

                                            {{ Carbon\Carbon::parse($trans->tanggal_transaksi)->translatedFormat('d-F-Y H:i:s') }}
                                        </p>

                                        <p class="mb-[3px] font-semibold">
                                            @if ($trans->harga_tiket == 0)
                                                {{ Carbon\Carbon::parse($trans->tanggal_transaksi)->translatedFormat('d-F-Y H:i:s') }}
                                            @else
                                                {{ $trans->waktu_pembayaran ? Carbon\Carbon::parse($trans->waktu_pembayaran)->translatedFormat('d-F-Y H:i:s') : 'Pesanan Belum Dibayar' }}
                                            @endif
                                        </p>


                                        @if ($trans->harga_tiket == 0)
                                            <p class="mb-[3px] text-slate-700 text-base font-bold uppercase ">
                                                Gratis
                                            </p>
                                        @else
                                            <p class="mb-[3px] text-slate-700 text-base font-bold uppercase ">
                                                Rp. {{ number_format($trans->harga_tiket) }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                            </div>

                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </section>
</x-app-costumer-layout>
