<x-app-layout>
  {{-- {{ dd($events) }} --}}



  <div class="eventShowComponent">
    <a href={{ route('admin_events_create') }} class='d-block btn text-primary w-fit bg-white'>
      <i class="fas-solid fa-plus"></i>
      Tambah data
    </a>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          {{-- <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div> --}}
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive data-table p-0">
              <table class="align-items-center mb-0 table">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-xs">
                      No</th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2 text-xs">
                      Nama </th>

                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Harga Tiket </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Tanggal Event </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Lokasi </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Pamflet </th>

                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($events as $event)
                    <tr>
                      <td class="text-center align-middle text-sm">
                        <span class=''>
                          {{ $loop->iteration }}</span>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-center text-xs capitalize">
                          {{ $event->nama_event }}
                        </p>
                      </td>
                      <td class="text-center align-middle text-sm">
                        @if ($event->harga_tiket == 0)
                          <span class='upercase font-bold'>Gratis</span>
                        @else
                          <span class=''>Rp.
                            {{ number_format($event->harga_tiket) }}</span>
                        @endif
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-xs">
                          {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-xs">
                          {{ $event->lokasi_acara }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <img class="img-preview-list img-fluidmx-auto d-block mx-auto rounded-md shadow-md"
                          src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                          loading="lazy">
                      </td>
                      <td class="mx-auto flex flex-col flex-wrap justify-center px-3 align-middle">
                        <a href='{{ route('admin_events_edit', $event->uuid) }}'
                          class="text-primary font-weight-bold btn btn-outline-primary text-xs" data-toggle="tooltip"
                          data-original-title="Edit event">
                          Edit
                        </a>



                        <form action="{{ route('admin_events_destroy', $event->uuid) }}" method="POST"
                          class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit"
                            class="btn-delete-event text-danger font-weight-bold btn btn-outline-danger text-xs">
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

  @push('js')
    @if (session())
      @if (session()->has('EventCreateSuccess'))
        <script>
          Swal.fire({
            title: '{{ session('EventCreateSuccess') }}',
            icon: 'success'
          })
        </script>
      @elseif (session()->has('deleteEventSuccess'))
        <script>
          Swal.fire({
            title: '{{ session('deleteEventSuccess') }}',
            icon: 'success'
          })
        </script>
      @elseif (session()->has('updateEventSuccess'))
        <script>
          Swal.fire({
            title: '{{ session('updateEventSuccess') }}',
            icon: 'success'
          })
        </script>
      @endif
    @endif



    <script>
      /* Confirm Dialog For Delete Item */
      document.querySelectorAll('.btn-delete-event').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Apakah kamu yakin ?',
            html: "<span style='color:#ef4444; font-size:1rem'>Data yang dihapus tidak dapat dikembalikan</span>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Hapus',
            cancelButtonText: 'Jangan Hapus'
          }).then((result) => {
            if (result.value) {
              btn.parentElement.submit();
            }
          })
        })
      })
    </script>


  @endpush


</x-app-layout>
