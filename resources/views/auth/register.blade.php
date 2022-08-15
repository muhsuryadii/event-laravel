<x-guest-layout>
  <x-jet-authentication-card>
    <x-slot name="logo">
      {{-- <x-jet-authentication-card-logo /> --}}
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="center pb-6 pt-1">
        <a class="mt-3 text-sm text-gray-600 underline hover:text-gray-900" href="/">
          {{-- <i class="fa-solid fa-arrow-left-long"></i> --}}
          {{ __('Kembali') }}
        </a>
        <img src=" {{ asset('image/logo_usni.png') }}" alt="logo" class="md:w-1/1 mx-auto block h-1/4 w-1/4 md:h-1/4">
        <h2 class="pt-4 text-center text-2xl font-bold uppercase">Register</h2>
      </div>

      <div>
        <x-jet-label for="nama" value="{{ __('Nama') }}" />
        <x-jet-input id="nama" class="form-control mt-1 block w-full" type="text" name="nama"
          :value="old('nama')" required autofocus autocomplete="nama" />
      </div>

      <div class="mt-4">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" class="form-control mt-1 block w-full" type="email" name="email"
          :value="old('email')" required />
      </div>

      <div class="mt-4">
        <x-jet-label for="password" value="{{ __('Password') }}" />
        <div class="input-password-wrapper flex">

          <x-jet-input id="password" class="mt-1 mr-3 block w-full" type="password" name="password" required />
          <button type="button" id="btn-show-password"
            class='focus:ring-opacity-500 rounded-md border border-gray-500 px-3 py-2 shadow-sm transition duration-300 ease-in-out hover:bg-slate-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 active:bg-slate-500'>
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <div class="mt-4">
        <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
        <div class="input-password-wrapper flex">

          <x-jet-input id="password_confirmation" class="mt-1 mr-3 block w-full" type="password"
            name="password_confirmation" required />
          <button type="button" id="btn-show-confirm-password"
            class='rounded-md border border-gray-500 px-3 py-2 shadow-sm transition duration-300 ease-in-out hover:bg-slate-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-slate-500'>
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>

      </div>

      {{-- Domisili Peserta --}}
      <div class="mb-4 mt-4">
        <label for="domisili" class="form-label text-base font-medium">Domisili</label>

        <select id="select-domisili" name="domisili" placeholder="Select a province..." autocomplete="off">


        </select>

        @error('domisili')
          <div id="domisili_feedback" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      {{-- End Domisili Peserta --}}


      {{-- Jenis Kelamin Peserta --}}
      <div class="mb-4">
        <label for="gender" class="form-label text-base font-medium">Jenis Kelamin</label>
        <select id='gender' name='gender' class="form-select" aria-label="Select gender">

          <option value="male">
            Laki-Laki</option>
          <option value="female">
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
          <label class="form-check-label capitalize" for="instansi-usni">
            <input class="form-check-input" type="radio" name="instansi" value="usni" id="instansi-usni">
            Universitas Satya Negara Indonesia
          </label>

        </div>
        <div class="form-check">
          <label class="form-check-label" for="others">
            <input class="form-check-input" type="radio" name="instansi" value="others" id="others" checked>
            Lainnya
          </label>
        </div>

        <div>
          <input type="text" class="form-control @error('instansi_lain') is-invalid @enderror mt-3 capitalize"
            id="instansi_lain" name='instansi_lain' placeholder="Perusahaan/ Yayasan/ Universitas/ Sekolah ">

          @error('instansi_lain')
            <div id="instansi_feedback" class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        @error('instansi_peserta')
          <div id="instansi_feedback" class="invalid-feedback d-block">

            @if ($message == 'validation.required')
              <small class="text-danger">Instansi harus diisi</small>
            @endif
          </div>
        @enderror
      </div>
      {{-- End Instansi Peserta --}}

      {{-- No Telepon Peserta --}}
      <div class="mb-4">
        <label for="no_telepon" class="form-label text-base font-medium capitalize">No HP/Whatsapp
          <span class="text-danger text-sm">(*)</span>
        </label>
        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" value=""
          onpaste="return validatePhone(this);" oninput="return validatePhone(this);" name='no_telepon'
          autocomplete="new no-hp" placeholder='62xxxxxxxx'>

        @error('no_telepon')
          <div id="no_telepon_feedback" class="invalid-feedback d-block">

            @if ($message == 'validation.required')
              <small class="text-danger">No Hp/WA harus diisi</small>
            @endif
          </div>
        @enderror
      </div>
      {{-- End No Telepon Peserta --}}


      {{-- Form Khsusus Mahasiswa USNI --}}
      <div class="usni-staff-wrapper d-none" id="usni-staff">
        {{-- Fakultas Peserta --}}
        <div class="mb-4">
          <label for="Fakultas" class="form-label text-base font-medium">Fakultas</label>
          <select id='fakultas' name='id_fakultas' class="form-select" aria-label="Select fakultas">
            <option>Pilih Fakultas</option>


          </select>

          @error('Fakultas')
            <div id="Fakultas_feedback" class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        {{-- End Fakultas Peserta --}}

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



        {{-- jurusan Peserta --}}
        <div class="mb-4">
          <label for="jurusan" class="form-label text-base font-medium">Jurusan / Prodi</label>

          <input type="text" class="form-control @error('jurusan') is-invalid @enderror capitalize" value=""
            id="jurusan" name='jurusan_peserta'>

          @error('jurusan')
            <div id="jurusan_feedback" class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        {{-- End jurusan Peserta --}}
      </div>

      {{-- Keterangan sebelum update profile --}}

      <p class="mb-1 font-semibold text-slate-800">
        <small>(**) Email dan No. HP/Whatsapp digunakan untuk menghubungi peserta jika ada
          informasi yang perlu disampaikan</small>
      </p>

      <div class="mt-4 flex items-center justify-end">
        <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
          {{ __('Sudah punya akun?') }}
        </a>

        <x-jet-button class="ml-4">
          {{ __('Register') }}
        </x-jet-button>
      </div>
    </form>
  </x-jet-authentication-card>

  @push('js')
    <script>
      const showPassword = (id, buttonId) => {
        const input = document.getElementById(id);
        const btn = document.getElementById(buttonId);
        const icon = btn.querySelector(`#${buttonId} i`);
        const type = input.getAttribute('type');

        if (type === 'password') {
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
          input.setAttribute('type', 'text');
        } else {
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
          input.setAttribute('type', 'password');
        }
      };

      const btnPassword = document.querySelector('#btn-show-password');
      const btnConfirmPassword = document.querySelector('#btn-show-confirm-password');
      btnPassword.addEventListener('click', () => {
        showPassword('password', 'btn-show-password');
      });
      btnConfirmPassword.addEventListener('click', () => {
        showPassword('password_confirmation', 'btn-show-confirm-password');
      });
    </script>

    {{-- Script for dynamic domisili --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

    {{-- Script for add validation Phone --}}
    <script>
      const validatePhone = (val) => {
        const regexIDN = /628[0-9]+$/;

        if (regexIDN.test(val.value)) {
          val.value = val.value.replace(/^[^6]+[2]+[8]/g, '628').replace(/[^0-9.]/g, '').replace(/[!@#$%^&*]/g, '');
        } else if (val.value.length >= 3 && !regexIDN.test(val.value)) {
          /628/.test(val.value) ? val.value = val.value.replace(/^[^6]+[2]+[8]/g, '').replace(/[!@#$%^&*]/g, '') : val
            .value = '62';
        } else if (val.value.length >= 2) {
          /62/.test(val.value) ? val.value = val.value.replace(/^[^6]+[2]/g, '').replace(/[!@#$%^&*]/g, '') : val
            .value = '6';
        } else {
          val.value = val.value.replace(/[!@#$%^&*]/g, '').replace(/[^0-9.]/g, '').replace(/^[^6]/g, '')
        }
      }
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


    {{-- script for domosili --}}
    <script>
      const domisiliSelect = document.querySelector('#select-domisili');

      document.addEventListener('DOMContentLoaded', async function() {

        const response = await fetch('https://ibnux.github.io/data-indonesia/provinsi.json');
        const data = await response.json();

        data.forEach(function(provinsi) {
          domisiliSelect.insertAdjacentHTML('beforeend', `
            <option value="${provinsi.nama}">${provinsi.nama}</option>
          `);
        });

        new TomSelect("#select-domisili", {
          create: true,
          sortField: {
            field: "text",
            direction: "asc"
          }
        });

      });
    </script>
    {{-- script for domosili --}}
    <script>
      const fakultasSelect = document.querySelector('#fakultas');

      document.addEventListener('DOMContentLoaded', async function() {

        const response = await fetch("http://event-laravel.test/api/fakultas")
        const data = await response.json();

        data.forEach(function(provinsi) {
          fakultasSelect.insertAdjacentHTML('beforeend', `
            <option value="${provinsi.id}">${provinsi.nama}</option>
          `);
        });


      });
    </script>

    {{-- Script for Angkatan --}}
    <script>
      const endYear = new Date().getFullYear();

      const startYear = endYear - 25;


      for (i = endYear; i >= startYear; i--) {
        let option = document.createElement('option');
        option.value = i;
        option.text = i;



        document.getElementById('angkatan').appendChild(option);
      }
    </script>
  @endpush
</x-guest-layout>
