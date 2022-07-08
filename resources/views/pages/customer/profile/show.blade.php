<x-app-costumer-layout>
    <section class="section py-10 ">
        <div class="container">
            <div
                class="user-card p-4 mb-3 card-wrapper bg-white rounded-2xl border shadow-[0_3px_10px_rgb(0,0,0,0.2)] border-slate-600 lg:w-2/3 mx-auto ">

                <div class="edit-profile-button w-fit ml-auto">
                    <a href="{{ route('profile_edit', $user->uuid) }}"
                        class="btn btn-primary btn-sm rounded-full px-4 py-2">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <span class="text-white">Edit Profile</span>
                    </a>
                </div>

                <div class="user-info-wrapper mt-3 flex">
                    <div class="title-user-info w-fitlk mr-4">
                        <h6 class="mb-[8px] ">Nama</h6>
                        <h6 class="mb-[8px] ">Email</h6>
                        <h6 class="mb-[8px] ">Tanggal Lahir</h6>
                        <h6 class="mb-[8px] ">Jenis Kelamin</h6>
                        <h6 class="mb-[8px] ">Instansi</h6>

                        @if ($peserta)
                            @if ($peserta->instansi_peserta == 'USNI')
                                <h6 class="mb-[8px] ">Angkatan</h6>
                                <h6 class="mb-[8px] ">Fakultas</h6>
                                <h6 class="mb-[8px] ">Jurusan</h6>
                            @endif
                        @endif
                    </div>
                    <div class="title-user-info w-fitlk mr-3">
                        <h6 class="mb-[8px] ">:</h6>
                        <h6 class="mb-[8px] ">:</h6>
                        <h6 class="mb-[8px] ">:</h6>
                        <h6 class="mb-[8px] ">:</h6>
                        <h6 class="mb-[8px] ">:</h6>

                        @if ($peserta)
                            @if ($peserta->instansi_peserta == 'USNI')
                                <h6 class="mb-[8px] ">:</h6>
                                <h6 class="mb-[8px] ">:</h6>
                                <h6 class="mb-[8px] ">:</h6>
                            @endif
                        @endif
                    </div>
                    <div class="title-user-info w-fitlk mr-4">
                        <h6 class="mb-[8px] ">{{ $user->nama_user }}</h6>
                        <h6 class="mb-[8px] ">{{ $user->email }}</h6>
                        <h6 class="mb-[8px] ">
                            {{ $peserta ? Carbon\Carbon::parse($peserta->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </h6>
                        <h6 class="mb-[8px] ">{{ $peserta ? ($peserta->gender == 'male' ? 'Pria' : 'Wanita') : '-' }}
                        </h6>
                        <h6 class="mb-[8px] ">{{ $peserta ? $peserta->instansi_peserta : '-' }}</h6>

                        @if ($peserta)
                            @if ($peserta->instansi_peserta == 'USNI')
                                <h6 class="mb-[8px] ">Angkatan</h6>
                                <h6 class="mb-[8px] ">Fakultas</h6>
                                <h6 class="mb-[8px] ">Jurusan</h6>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
    </section>

</x-app-costumer-layout>
