<x-app-costumer-layout>
    {{-- {{ dd($provinsi[0]['nama']) }} --}}
    {{-- {{ dd($peserta) }} --}}

    <section class="section py-10 ">
        <div class="container">
            <div class="user-wrapper lg:w-2/3 mx-auto">
                <form method="POST" class="form-wrapper w-full " action="{{ route('profile_update', $user->uuid) }}">
                    @csrf
                    {{-- Nama Peserta --}}
                    <div class="mb-4">
                        <label for="nama_peserta" class="form-label font-medium capitalize text-base">Nama Peserta <span
                                class="text-sm text-danger">(*)</span>
                        </label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                            value="{{ old('nama_peserta', $user->nama_user) }}" id="nama_peserta" name='nama_peserta'
                            required>
                        <p class='text-xs mt-1 text-danger'>
                            Nama digunakan untuk sertifikat, mohon input data yang benar
                        </p>

                        <input hidden type="text" class="form-control d-none" value={{ $user->id }}
                            id="id_user" name='id_user'>

                        @error('nama_peserta')
                            <div id="nama_peserta_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- End Nama Peserta --}}

                    {{-- Email Peserta --}}
                    <div class="mb-4">
                        <label for="email" class="form-label font-medium text-base ">Email</label>
                        <input disabled type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" id="email" name='email'>

                        @error('email')
                            <div id="email_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- End Email Peserta --}}

                    {{-- Domisili Peserta --}}
                    <div class="mb-4">
                        <label for="domisili" class="form-label font-medium text-base ">Domisili</label>

                        <select id="select-domisili" placeholder="Select a person..." autocomplete="off">
                            <option>Pilih Domisili</option>



                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov['nama'] }}">{{ $prov['nama'] }}</option>
                            @endforeach
                        </select>

                        @error('domisili')
                            <div id="domisili_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- End Domisili Peserta --}}

                    {{-- Tanggal Lahir Peserta --}}
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="form-label font-medium  text-base ">Tanggal Lahir</label>

                        @if ($peserta && $peserta->tanggal_lahir)
                            <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', date('Y-m-d\TH:i', strtotime($peserta->tanggal_lahir))) }}">
                        @else
                            <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        @endif

                        @error('tanggal_lahir')
                            <div id="tanggal_lahir_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- End Tanggal Lahir Peserta --}}

                    {{-- Jenis Kelamin Peserta --}}
                    <div class="mb-4">
                        <label for="gender" class="form-label font-medium  text-base ">Jenis Kelamin</label>
                        <select id='gender' name='gender' class="form-select" aria-label="Select gender">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="male" {{ $peserta && $peserta->gender === 'male' ? ' selected' : '' }}>
                                Laki-Laki</option>
                            <option value="female"
                                {{ $peserta && $peserta->gender === 'female' ? ' selected' : '' }}>
                                Perempuan</option>
                        </select>


                        @error('gender')
                            <div id="gender_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- End Jenis Kelamin Peserta --}}

                    {{-- Instansi Peserta --}}
                    <div class="mb-4">
                        <label for="instansi" class="form-label font-medium  text-base ">Instansi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="instansi" value="usni"
                                id="usni">
                            <label class="form-check-label capitalize" for="usni">
                                Universitas Satya Negara Indonesia
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="instansi" value="others"
                                id="others">
                            <label class="form-check-label" for="others">
                                Lainnya
                            </label>

                        </div>
                        <div>
                            <input type="text"
                                class="form-control capitalize d-none @error('instansi') is-invalid @enderror"
                                id="instansi_lain" name='instansi'
                                placeholder="Perusahaan/ Yayasan/ Universitas/ Sekolah ">
                            @error('instansi')
                                <div id="instansi_feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- End Instansi Peserta --}}

                    {{-- Form Khsusus Mahasiswa USNI --}}



                    <div class="usni-staff-wrapper">
                        {{-- Angkatan Peserta --}}
                        <div class="mb-4">
                            <label for="angkatan" class="form-label font-medium  text-base ">Angkatan</label>


                            <select id='angkatan' name='angkatan' class="form-select" aria-label="Select angkatan">

                            </select>


                            @error('angkatan')
                                <div id="angkatan_feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End Angkatan Peserta --}}

                        {{-- Fakultas Peserta --}}
                        <div class="mb-4">
                            <label for="Fakultas" class="form-label font-medium  text-base ">Fakultas</label>
                            <select id='fakultas' name='fakultas' class="form-select" aria-label="Select fakultas">
                                <option selected>Pilih Fakultas</option>

                                @foreach ($fakultas as $fak)
                                    <option value="{{ $fak->id }}">{{ $fak->nama }}
                                        {{ old('fakultas', $peserta && $peserta->id_fakultas ? $peserta->id_fakultas : '') === $fak->id ? 'selected' : '' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('Fakultas')
                                <div id="Fakultas_feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End Fakultas Peserta --}}

                        {{-- jurusan Peserta --}}
                        <div class="mb-4">
                            <label for="jurusan" class="form-label font-medium  text-base ">Jurusan / Prodi</label>


                            <input type="text"
                                class="form-control capitalize @error('jurusan') is-invalid @enderror"
                                value="{{ old('jurusan', $peserta && $peserta->jurusan_peserta ? $peserta->jurusan_peserta : '') }}"
                                id="jurusan" name='jurusan'>


                            @error('jurusan')
                                <div id="jurusan_feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End jurusan Peserta --}}
                    </div>


                </form>
            </div>
        </div>
    </section>

    @push('js')
        {{-- Script for dynamic domisili --}}
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

        <script>
            new TomSelect("#select-domisili", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        </script>

        {{-- Script for instansi --}}
        <script>
            const instansi = document.querySelectorAll('input[name="instansi"]');

            instansi.forEach(function(instansi) {
                instansi.addEventListener('change', function(e) {
                    console.log(e.target.value);
                    if (e.target.value === 'others') {
                        document.querySelector('#instansi_lain').classList.remove('d-none');
                    } else {
                        document.querySelector('#instansi_lain').classList.add('d-none');
                    }
                });
            });
        </script>

        {{-- Script for Angkatan --}}
        <script>
            const startYear = 1970;
            if ($peserta && $peserta.angkatan) {
                let angkatan = $peserta.angkatan;
            } else {
                let angkatan = '';
            }
            const endYear = new Date().getFullYear();
            for (i = endYear; i >= startYear; i--) {
                let option = document.createElement('option');
                option.value = i;
                option.text = i;

                document.getElementById('angkatan').appendChild(option);
            }
        </script>
    @endpush

</x-app-costumer-layout>
