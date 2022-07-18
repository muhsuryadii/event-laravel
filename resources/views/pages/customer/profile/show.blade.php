<x-app-costumer-layout>
  <section class="section py-10">
    <div class="container">
      <div
        class="user-card card-wrapper mx-auto mb-3 rounded-2xl border border-slate-600 bg-white p-4 shadow-[0_3px_10px_rgb(0,0,0,0.2)] lg:w-2/3">

        <div class="edit-profile-button ml-auto w-fit">
          <a href="{{ route('profile_edit', $user->uuid) }}" class="btn btn-primary btn-sm rounded-full px-4 py-2">
            <i class="fa-regular fa-pen-to-square"></i>
            <span class="text-white">Edit Profile</span>
          </a>
        </div>

        <div class="user-info-wrapper mt-3 flex">
          <div class="title-user-info w-fitlk mr-4">
            <h6 class="mb-[8px]">Nama</h6>
            <h6 class="mb-[8px]">Email</h6>
            <h6 class="mb-[8px]">Jenis Kelamin</h6>
            <h6 class="mb-[8px]">Instansi</h6>

            @if ($peserta)
              @if ($peserta->instansi_peserta == 'USNI')
                <h6 class="mb-[8px]">Angkatan</h6>
                <h6 class="mb-[8px]">Fakultas</h6>
                <h6 class="mb-[8px]">Jurusan</h6>
              @endif
            @endif
          </div>
          <div class="title-user-info w-fitlk mr-3">
            <h6 class="mb-[8px]">:</h6>
            <h6 class="mb-[8px]">:</h6>
            <h6 class="mb-[8px]">:</h6>
            <h6 class="mb-[8px]">:</h6>

            @if ($peserta)
              @if ($peserta->instansi_peserta == 'USNI')
                <h6 class="mb-[8px]">:</h6>
                <h6 class="mb-[8px]">:</h6>
                <h6 class="mb-[8px]">:</h6>
              @endif
            @endif
          </div>
          <div class="title-user-info w-fitlk mr-4">
            <h6 class="mb-[8px]">{{ $user->nama_user }}</h6>
            <h6 class="mb-[8px]">{{ $user->email }}</h6>
            <h6 class="mb-[8px]">{{ $peserta ? ($peserta->gender == 'male' ? 'Laki-Laki' : 'Perempuan') : '-' }}
            </h6>
            <h6 class="mb-[8px]">
              {{ $peserta && $peserta->instansi_peserta ? ($peserta->instansi_peserta === 'usni' ? 'Universitas Satya Negara Indonesia' : $peserta->instansi_peserta) : '-' }}
            </h6>

            @if ($peserta)
              @if ($peserta->instansi_peserta == 'USNI')
                <h6 class="mb-[8px]">Angkatan</h6>
                <h6 class="mb-[8px]">Fakultas</h6>
                <h6 class="mb-[8px]">Jurusan</h6>
              @endif
            @endif
          </div>

        </div>
      </div>
  </section>

</x-app-costumer-layout>
