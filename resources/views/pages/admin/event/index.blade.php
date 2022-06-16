<x-app-layout>
    {{-- {{ dd($events) }} --}}

    <div class="eventShowComponent">
        <a href={{ route('admin_events_create') }} class='d-block w-fit btn bg-white text-primary '>
            <i class="fas-solid fa-plus "></i>
            Tambah data
        </a>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div> --}}
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
                                            Harga Tiket </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Tanggal Event </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Lokasi </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Pamflet </th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span class=''>
                                                    {{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 capitalize text-center">
                                                    {{ $event->nama_event }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class=''>Rp.
                                                    {{ number_format($event->harga_tiket) }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $event->lokasi_acara }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <img class="img-preview-list img-fluidmx-auto mx-auto d-block shadow-md rounded-md"
                                                    src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                                    loading="lazy">
                                            </td>
                                            <td
                                                class="align-middle flex flex-wrap flex-col mx-auto justify-center px-3">
                                                <a href='{{ route('admin_events_edit', $event->slug) }}'
                                                    class="text-primary font-weight-bold text-xs btn btn-outline-primary"
                                                    data-toggle="tooltip" data-original-title="Edit event">
                                                    Edit
                                                </a>



                                                <form action="{{ route('admin_events_destroy', $event->slug) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-danger font-weight-bold text-xs btn btn-outline-danger">
                                                        Delete
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <livewire:events-table /> --}}

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
