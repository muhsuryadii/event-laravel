<x-app-layout>

  <div class="eventShowComponent">
    <a href={{ route('admin_panitia_create') }} class='d-block btn text-primary w-fit bg-white'>
      <i class="fas-solid fa-plus"></i>
      Tambah data
    </a>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">

          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive data-table p-0">
              <table class="align-items-center mb-0 table table-fixed">

                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-xs">
                      No</th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2 text-xs">
                      Nama </th>

                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Email </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-center text-xs">
                      Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($panitias as $panitia)
                    <tr>
                      <td class="text-center align-middle text-base">
                        <span class=''>
                          {{ $loop->iteration }}</span>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-center text-sm capitalize">
                          {{ $panitia->nama_user }}
                        </p>
                      </td>
                      <td class="text-center align-middle text-base">
                        <p class="font-weight-bold mb-0 text-center text-sm">
                          {{ $panitia->email }}
                        </p>
                      </td>

                      <td class="w-100 mx-auto flex flex-row flex-wrap justify-center px-3 align-middle md:flex-col">
                        <a href='{{ route('admin_panitia_edit', $panitia->uuid) }}'
                          class="text-primary font-weight-bold btn btn-outline-primary mr-0 text-xs md:mr-3"
                          data-toggle="tooltip" data-original-title="Edit event">
                          Edit
                        </a>



                        <form action="{{ route('admin_panitia_destroy', $panitia->uuid) }}" method="POST"
                          class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit"
                            class="btn-delete-event text-danger font-weight-bold btn btn-outline-danger text-xs">
                            Delete
                          </button>
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
