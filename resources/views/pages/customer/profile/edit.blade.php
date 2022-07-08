<x-app-costumer-layout>
    {{-- {{ dd($peserta) }} --}}
    <section class="section py-10 ">
        <div class="container">
            <div class="user-wrapper lg:w-2/3 mx-auto">
                <form method="POST" class="form-wrapper w-full " action="{{ route('profile_update', $user->uuid) }}">
                    @csrf
                    {{-- Nama Peserta --}}
                    <div class="mb-4">
                        <label for="nama_peserta" class="form-label font-medium text-base">Nama Peserta <span
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

                        <select id="select-beast" placeholder="Select a person..." autocomplete="off">
                            <option value="">Select a person...</option>
                            <option value="4">Thomas Edison</option>
                            <option value="1">Nikola</option>
                            <option value="3">Nikola Tesla</option>
                            <option value="5">Arnold Schwarzenegger</option>
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


                </form>
            </div>
        </div>
    </section>

    @push('js')
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

        new TomSelect("#select-beast",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
        }
        });

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
    @endpush

</x-app-costumer-layout>
