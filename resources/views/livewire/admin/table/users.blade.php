<div>
  <x-data-table :model="$users">
    <x-slot name="head">
      <tr>
        <th><a wire:click.prevent="" role="button" href="#">
            No.
          </a></th>
        <th><a wire:click.prevent="sortBy('nama_user')" role="button" href="#">
            Name
            @include('components.sort-icon', ['field' => 'nama_user'])
          </a></th>
        <th><a wire:click.prevent="sortBy('instansi_peserta')" role="button" href="#">
            Instansi
            @include('components.sort-icon', ['field' => 'instansi_peserta'])
          </a></th>
        <th><a wire:click.prevent="sortBy('status_absen')" role="button" href="#">
            Cek Absensi
            @include('components.sort-icon', ['field' => 'status_absen'])
          </a></th>
      </tr>
    </x-slot>
    <x-slot name="body">
      @foreach ($users as $user)
        <tr>
          <td class="text-center">{{ $users->firstItem() + $loop->index }}</td>
          <td>{{ $user->nama_user }}</td>
          <td class="capitalize">
            {{ $user->instansi_peserta == 'usni' ? 'Universitas Satya Negara Indonesia' : $user->instansi_peserta }}
          </td>
          @if ($user->status_absen)
            <td class='text-success text-center text-base font-semibold !text-green-500'>Hadir</td>
          @else
            <td class='text-warning text-center text-base font-semibold !text-red-500'>Tidak Hadir</td>
          @endif
        </tr>
      @endforeach
    </x-slot>
  </x-data-table>
</div>
