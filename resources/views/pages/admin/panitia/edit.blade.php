<x-app-layout>


  <div class="card mb-4">

    <div class="card-body px-0 pt-0 pb-2">
      <form action="{{ route('admin_panitia_update', $panitia->uuid) }}" method="POST" class="m-4"
        id="formCreatePanitia">
        @csrf
        @method('PUT')


        {{-- Nama Panitia --}}
        <div class="mb-3">
          <div class="form-group">
            <label for="nama_panitia" class="form-label text-sm">Nama
              Panitia <span class="text-xxs text-danger">(*)</span> </label>
            <input type="text" class="form-control @error('nama_panitia') is-invalid @enderror" id="nama_panitia"
              name='nama_panitia' autofocus='true' required value="{{ old('nama_panitia', $panitia->nama_user) }}"
              placeholder="Masukan Nama Panitia">
            <input type="hidden" class="form-control @error('uuid') is-invalid @enderror" id="uuid" name='uuid'
              value="{{ old('uuid', $panitia->uuid) }}">

            @error('nama_panitia')
              <div id="nama_panitia_feedback" class="invalid-feedback d-block">
                {{ $message }}
              </div>
            @enderror

          </div>

        </div>

        {{-- Email Panitia --}}
        <div class="mb-3">
          <div class="form-group">


            <label for="email_panitia" class="form-label text-sm">Email
              <span class="text-xxs text-danger">(*)</span> </label>
            <input type="email" class="form-control @error('email_panitia') is-invalid @enderror" id="email_panitia"
              name='email_panitia' required value="{{ old('email_panitia', $panitia->email) }}"
              placeholder="Masukan Email">

            @error('email')
              <div id="email_panitia_feedback" class="invalid-feedback d-block">
                @if ($message == 'validation.email')
                  Email tidak valid, mohon masukan email yang valid.
                @elseif ($message == 'validation.unique')
                  Email telah digunakan, mohon gunakan email lain
                @else
                  {{ $message }}
                @endif
              </div>
            @enderror
          </div>
        </div>

        {{-- Password Panitia --}}
        <div class="mb-3">
          <div class="form-group">

            <label for="password_panitia" class="form-label text-sm">Password<span
                class="text-xxs text-danger">(*)</span>
            </label>
            <div class="input-wrapper flex">

              <input type="password" class="form-control @error('password_panitia') is-invalid @enderror mr-3"
                id="password_panitia" name='password_panitia' value="{{ old('password_panitia') }}"
                placeholder="Masukan Password">
              <button type="button" id="btn-show-password"
                class='focus:ring-opacity-500 rounded-md border border-gray-500 px-3 py-2 transition duration-300 ease-in-out hover:bg-slate-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 active:bg-slate-500'>
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            @error('password')
              <div id="password_panitia_feedback" class="invalid-feedback d-block">
                @if ($message == 'validation.min')
                  Password minimal 6 karakter
                @else
                  {{ $message }}
                @endif
              </div>
            @enderror
          </div>
        </div>

        {{-- Konfirmasi Password Panitia --}}
        <div class="mb-3">
          <div class="form-group">

            <label for="password_confirmation" class="form-label text-sm">Konfirmasi Password<span
                class="text-xxs text-danger">(*)</span>
            </label>
            <div class="input-wrapper flex">

              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror mr-3"
                id="password_confirmation" name='password_confirmation' autofocus='true'
                value="{{ old('password_confirmation') }}" placeholder="Masukan Konfirmasi Password">
              <button type="button" id="btn-show-confirm-password"
                class='rounded-md border border-gray-500 px-3 py-2 transition duration-300 ease-in-out hover:bg-slate-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-slate-500'>
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            @error('password_confirmation')
              <div id="password_confirmation_feedback" class="invalid-feedback d-block">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        <small class='mb-3 font-semibold'>
          Kosongkan password jika tidak ingin mengganti password
        </small>

        <button type="submit" class="font-weight-bold btn btn-primary d-block w-full" id='buttonSimpanPanitia'>
          Update
        </button>


      </form>
    </div>

  </div>
  @push('js')
    {{-- show password --}}
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
        showPassword('password_panitia', 'btn-show-password');
      });
      btnConfirmPassword.addEventListener('click', () => {
        showPassword('password_confirmation', 'btn-show-confirm-password');
      });
    </script>

    {{-- Sweet alert --}}
    <script>
      const btnSimpan = document.querySelector('#buttonSimpanPanitia');

      const nama = document.querySelector('#nama_panitia');
      const email = document.querySelector('#email_panitia');
      const formValidation = () => {
        if (
          nama.value == '' ||
          email.value == '' ||

        ) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Semua field harus diisi!',
            showConfirmButton: false,
            timer: 3000
          });
          return false;
        } else {
          return true;
        }
      };


      btnSimpan.addEventListener('click', function(e) {
        e.preventDefault();


        if (formValidation()) {

          Swal.fire({
            title: 'Apakah Data Sudah Benar ?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Sudah, Update!',
            denyButtonText: `Belum`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              document.getElementById('formCreatePanitia').submit();
            }
          })
        }
      })
    </script>
  @endpush

</x-app-layout>
