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
            {{ $user->instansi_peserta == 'usni' ? 'UNIVERSITAS SATYA NEGARA INDONESIA' : $user->instansi_peserta }}
          </td>
          <td>{{ $user->status_absen }}</td>
        </tr>
      @endforeach
    </x-slot>
  </x-data-table>
</div>
