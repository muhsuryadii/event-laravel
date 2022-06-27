<x-app-layout>
    {{-- {{ dd($transaksi) }} --}}
    <div class="row">
        <div class="col-12">
            <h4 class='font-bold text-white text-xl mt-3'>Nama Event : {{ $event->nama_event }}</h4>

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
                                                <p
                                                    class="text-xs font-weight-bold mb-0 capitalize text-center no-underline ">

                                                    <a href="{{ asset('storage/' . $trans->bukti_transaksi) }}"
                                                        target="_blank" class='text-primary'>
                                                        Lihat Bukti Pembayaran <i
                                                            class="fa-solid fa-arrow-up-right-from-square"></i>
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                <form action='{{ route('admin_transaksi_update', $trans->uuid) }}'
                                                    method="POST" class="flex justify-evenly">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status_transaksi">

                                                    {{-- <button type="button" class="btn btn-primary verify-button"
                                                        id="btnVerifyOrder" onclick="return verifyButton(this.form)">
                                                        <i class="fa-solid fa-check text-lg"></i>
                                                    </button> --}}

                                                    @if ($trans->status_transaksi != 'verified')
                                                        <button type="button" class="btn btn-primary verify-button"
                                                            id="btnVerifyOrder" onclick="return verifyButton(this.form)"
                                                            title="Verifikasi Pembayaran">

                                                            <i class="fa-solid fa-check text-lg"></i>
                                                        </button>
                                                    @else
                                                        <span class="btn btn-success verify-button disabled" disabled
                                                            title="Verifikasi Pembayaran">
                                                            <i class="fa-solid fa-check text-lg text-white"></i>
                                                        </span>
                                                    @endif

                                                    @if ($trans->total_harga != 0)
                                                        <button type="button" class="btn btn-danger reject-button"
                                                            onclick="return rejectButton(this.form)"
                                                            title="Tolak Pembayaran">
                                                            <i class="fa-solid fa-xmark text-lg"></i>
                                                        </button>
                                                    @endif


                                                </form>


                                                {{-- @if ($trans->status_transaksi != 'not_paid')
                                                    <button type="submit" disabled
                                                        class="btn btn-success btn-sm text-white">
                                                        Success</button>
                                                @endif --}}

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
    @push('js')
        {{-- Sweet alert --}}
        <script>
            const verifyButton = (form) => {
                Swal.fire({
                    title: 'Pembayaran Diverifikasi ?',
                    text: "Pastikan bukti pembayaran sudah sesuai dengan harga event",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, Verifikasi Pembayaran',
                    denyButtonText: `Batal`,
                }).then((result) => {
                    if (result.value) {
                        const input = form.querySelector('input[name="status_transaksi"]');
                        input.value = 'verified';
                        form.submit();
                    }
                })
            }


            const rejectButton = (form) => {

                Swal.fire({
                    title: 'Tolak Verfikasi Pembayaran ?',
                    text: "Pembayaran akan dihapus dari halaman ini dan peserta harus input ulang bukti pembayaran jika verifikasi pembayaran ditolak",
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, Tolak Verifikasi Pembayaran',
                    denyButtonText: `Batal`,
                }).then((result) => {
                    if (result.value) {
                        const input = form.querySelector('input[name="status_transaksi"]');
                        input.value = 'rejected';
                        form.submit();
                    }
                })
            }
        </script>
    @endpush
</x-app-layout>
