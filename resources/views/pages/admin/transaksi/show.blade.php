<x-app-layout>
    {{-- {{ dd($transaksi) }} --}}
    <div class="row">
        <div class="col-12">
            <h4 class='font-bold text-white text-xl mt-3'>Event : {{ $event->nama_event }}</h4>

            @if (count($transaksi) == 0)
                <div class="text-white mt-3">
                    <h4 class="alert-heading">Oops!</h4>
                    <p>
                        Belum ada transaksi yang dilakukan.
                    </p>
                </div>
            @else
                <div class="card mb-4">

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 data-table">
                            <table class="table table-fixed align-items-center mb-0">

                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7 ps-2">
                                            Nama </th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            No Telp </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Tanggal Bayar </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Bukti Transaksi </th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($transaksi as $trans)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span class=''>
                                                    {{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 capitalize text-center">
                                                    {{ $trans->nama_user }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 capitalize text-center">
                                                    {{ $trans->no_telepon }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 capitalize text-center">

                                                    {{ Carbon\Carbon::parse($trans->tanggal_transaksi)->translatedFormat('d F Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 capitalize text-center">

                                                    <a class="underline"
                                                        href="{{ asset('storage/' . $trans->bukti_transaksi) }}"
                                                        target="_blank">
                                                        Lihat Bukti Pembayaran
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                @if ($trans->status_transaksi == 'pending')
                                                    <form
                                                        action='{{ route('admin_transaksi_update', $trans->no_transaksi) }}'
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit"
                                                            class="btn btn-primary btn-simpan btn-sm">
                                                            Verifikasi</button>
                                                    </form>
                                                @else
                                                    <button type="submit" disabled
                                                        class="btn btn-success btn-simpan btn-sm text-white">
                                                        Success</button>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
