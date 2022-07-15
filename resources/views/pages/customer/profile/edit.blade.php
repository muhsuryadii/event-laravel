<x-app-costumer-layout>
  {{-- {{ dd($provinsi[0]['nama']) }} --}}
  {{-- {{ dd($peserta) }} --}}

  <section class="section py-10">
    <div class="container">
      <div class="user-wrapper mx-auto lg:w-2/3">
        <form method="POST" class="form-wrapper w-full" action="{{ route('profile_update', $user->uuid) }}"
          id='formEditProfile'>
          @csrf
          @method('PUT')
          {{-- Nama Peserta --}}
          <div class="mb-4">
            <label for="nama_peserta" class="form-label text-base font-medium capitalize">Nama Peserta <span
                class="text-danger text-sm">(*)</span>
            </label>
            <input type="text" class="form-control @error('nama_user') is-invalid @enderror capitalize"
              value="{{ old('nama_user', $user->nama_user) }}" id="nama_user" name='nama_user' required>

            <input hidden type="text" class="form-control d-none" value={{ $user->id }} id="id_user"
              name='id_user'>

            @error('nama_user')
              <div id="nama_user_feedback" class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          {{-- End Nama Peserta --}}

          {{-- Email Peserta --}}
          <div class="mb-4">
            <label for="email" class="form-label text-base font-medium">Email</label>
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
            <label for="domisili" class="form-label text-base font-medium">Domisili</label>

            <select id="select-domisili" name="domisili" placeholder="Select a province..." autocomplete="off">


              @foreach ($provinsi as $prov)
                <option value="{{ $prov['nama'] }}"
                  {{ old('domisili', $peserta && $peserta->domisili) == $prov['nama'] ? 'selected' : '' }}>
                  {{ $prov['nama'] }}</option>
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
            <label for="tanggal_lahir" class="form-label text-base font-medium">Tanggal Lahir</label>

            @if ($peserta && $peserta->tanggal_lahir)
              <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                name="tanggal_lahir"
                value="{{ old('tanggal_lahir', date('Y-m-d', strtotime($peserta->tanggal_lahir))) }}">
            @else
              <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
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
            <label for="gender" class="form-label text-base font-medium">Jenis Kelamin</label>
            <select id='gender' name='gender' class="form-select" aria-label="Select gender">

              <option value="male" {{ $peserta && $peserta->gender === 'male' ? ' selected' : '' }}>
                Laki-Laki</option>
              <option value="female" {{ $peserta && $peserta->gender === 'female' ? ' selected' : '' }}>
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
            <label for="instansi" class="form-label text-base font-medium">Instansi <span
                class="text-danger text-sm">(*)</span></label>
            {{-- <input type="hidden" name="instansi_hidden" id=""> --}}
            <div class="form-check">
              <input class="form-check-input" type="radio" name="instansi" value="usni" id="usni "
                {{ $peserta && $peserta->instansi_peserta === 'usni' ? ' checked' : '' }}>
              <label class="form-check-label capitalize" for="usni">
                Universitas Satya Negara Indonesia
              </label>

            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="instansi" value="others" id="others"
                {{ $peserta && $peserta->instansi_peserta !== 'usni' ? ' checked' : '' }}>
              <label class="form-check-label" for="others">
                Lainnya
              </label>
            </div>
            <div>
              <input type="text"
                class="form-control {{ $peserta && $peserta->instansi_peserta !== 'usni' ? '' : 'd-none' }} @error('instansi_lain') is-invalid @enderror capitalize"
                id="instansi_lain" name='instansi_lain' placeholder="Perusahaan/ Yayasan/ Universitas/ Sekolah "
                value="{{ old('instansi_lain', $peserta && $peserta->instansi_peserta !== 'usni' ? $peserta->instansi_peserta : '') }}">


              @error('instansi_lain')
                <div id="instansi_feedback" class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          {{-- End Instansi Peserta --}}

          {{-- No Telepon Peserta --}}
          <div class="mb-4">
            <label for="no_telepon" class="form-label text-base font-medium capitalize">No Telepon
            </label>
            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
              value="{{ old('no_telepon', $peserta && $peserta->no_telepon ? $peserta->no_telepon : '') }}"
              id="no_telepon" name='no_telepon' placeholder='62xxxxxxxx'>


            @error('no_telepon')
              <div id="no_telepon_feedback" class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          {{-- End No Telepon Peserta --}}


          {{-- Form Khsusus Mahasiswa USNI --}}
          <div class="usni-staff-wrapper {{ $peserta && $peserta->instansi_peserta == 'usni' ? '' : 'd-none' }}"
            id="usni-staff">
            {{-- Angkatan Peserta --}}
            <div class="mb-4">
              <label for="angkatan" class="form-label text-base font-medium">Angkatan</label>


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
              <label for="Fakultas" class="form-label text-base font-medium">Fakultas</label>
              <select id='fakultas' name='fakultas' class="form-select" aria-label="Select fakultas">
                <option>Pilih Fakultas</option>

                @foreach ($fakultas as $fak)
                  <option value="{{ $fak->id }}"
                    {{ old('fakultas', $peserta && $peserta->id_fakultas ? $peserta->id_fakultas : '') == $fak->id
                        ? 'selected'
                        : '' }}>
                    {{ $fak->nama }}

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
              <label for="jurusan" class="form-label text-base font-medium">Jurusan / Prodi</label>


              <input type="text" class="form-control @error('jurusan') is-invalid @enderror capitalize"
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

          <button type="submit" id='buttonEditProfile' class="btn btn-primary w-100 btn-simpan mb-4">Update
            Profile</button>
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

    {{-- Toogle Script for instansi --}}
    <script>
      const resetFormInstansi = () => {
        document.querySelector('#instansi_lain').value = ''
      }

      const resetFormMahasiswa = () => {
        document.querySelector('#angkatan').selectedIndex = 0;
        document.querySelector('#fakultas').selectedIndex = 0;
        document.querySelector('#jurusan').value = ''
      }

      const instansi = document.querySelectorAll('input[name="instansi"]');
      const usniFormWrapper = document.querySelector('#usni-staff');
      // const instansiHidden = document.querySelector('input[name="instansi_hidden"]');
      instansi.forEach(function(instansi) {
        instansi.addEventListener('change', function(e) {
          // instansiHidden.value = e.target.value;
          if (e.target.value === 'others') {
            document.querySelector('#instansi_lain').classList.remove('d-none');
            usniFormWrapper.classList.add('d-none');
            resetFormMahasiswa();
          } else {
            document.querySelector('#instansi_lain').classList.add('d-none');
            usniFormWrapper.classList.remove('d-none');
            resetFormInstansi();
          }
        });
      });
    </script>

    {{-- Script for Angkatan --}}
    <script>
      const endYear = new Date().getFullYear();

      const startYear = endYear - 25;
      @if ($peserta && $peserta->angkatan)
        let angkatan = {{ $peserta->angkatan }};
      @else
        let angkatan = '';
      @endif

      for (i = endYear; i >= startYear; i--) {
        let option = document.createElement('option');
        option.value = i;
        option.text = i;
        if (angkatan === i) {
          option.selected = true;
        }

        document.getElementById('angkatan').appendChild(option);
      }
    </script>

    {{-- Script for Sweet alert --}}
    <script>
      const btnEdit = document.querySelector('#buttonEditProfile');
      btnEdit.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah Data Sudah Benar ?',
          icon: 'question',
          showDenyButton: true,
          confirmButtonText: 'Sudah, Simpan!',
          denyButtonText: `Belum`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.getElementById('formEditProfile').submit();
          }
        })
      })
    </script>
  @endpush

</x-app-costumer-layout>
