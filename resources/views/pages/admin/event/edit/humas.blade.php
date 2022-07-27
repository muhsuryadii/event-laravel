<form action='{{ route('admin_events_update_humas', $event->uuid) }}' method="POST" class="p-[1.5rem]" id="formStepHumas">
  @csrf
  @method('put')

  <div class="mb-4">
    <div class="humas-wrapper">
      <div class="form-group text-left">
        <label for="wa_grup" class="form-label text-left text-lg">Grup Whatsapp</label>
        <input type="url" class="form-control @error('wa_grup') is-invalid @enderror" name='wa_grup' id="wa_grup"
          autofocus='true' value="{{ old('wa_grup', $event->wa_grup) }}"
          placeholder="https://chat.whatsapp.com/xxxxxxxxxxxxxx" pattern="https://.*">
        @error('wa_grup')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
    </div>

    <button class="btn btn-outline-primary btn-tambah-humas d-block ml-auto active:bg-blue-100" type='button'>
      <i class="fa-solid fa-plus mr-2"></i>
      Tambah Humas
    </button>
    <div class="humas-wrapper-list">
      @if (count($humas) == 0)
        <div class="humas-wrapper">
          <label for="name" class="form-label d-block text-left text-lg">Humas
            1</label>
          <div class="form-group text-left">
            <label for="nama_humas[]" class="form-label text-left text-sm">Nama
              Humas</label>
            <input type="text" class="form-control @error('nama_humas[]') is-invalid @enderror" name='nama_humas[]'
              id="nama_humas[]" autofocus='true' value="{{ old('nama_humas[]') }}" placeholder="Masukan Nama Humas">
            @error('nama_humas[]')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-group text-left">
            <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp
              Humas</label>
            <input type="text" class="form-control @error('no_wa[]') is-invalid @enderror" name='no_wa[]'
              id='no_wa[]' autofocus='true' value="{{ old('no_wa[]') }}" placeholder="628xxxxxxxxxx"
              onpaste="return validatePhone(this);" oninput="return validatePhone(this);">
            @error('no_wa[]')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>
      @else
        @foreach ($humas as $hum)
          <div class="humas-wrapper">
            <label for="name" class="form-label d-block text-left text-lg">Humas
              {{ $loop->iteration }} </label>
            <div class="form-button d-flex w-full items-center">
              <div class="form-wrapper d-flex w-3/4 flex-col pr-5">
                <div class="form-group text-left">
                  <label for="nama_humas[]" class="form-label text-left text-sm">Nama Humas</label>
                  <input type="text" class="form-control" name='nama_humas[]' id="nama_humas[]" autofocus='true'
                    placeholder="Masukan Nama Humas" value="{{ old('nama_humas[]', $hum->nama) }}">
                </div>
                <div class="form-group text-left">
                  <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp Humas</label>
                  <input type="text" class="form-control" name='no_wa[]' id='no_wa[]' autofocus='true'
                    placeholder="628xxxxxxxxxx" onpaste="return validatePhone(this);"
                    oninput="return validatePhone(this)"; value="{{ old('no_wa[]', $hum->no_wa) }}">
                </div>
              </div>
              <button class="btn btn-outline-danger btn-hapus-humas d-block h-fit w-1/4" type='button'
                onclick="return deleteHumas(this);">
                <i class="fa-solid fa-times mr-2"></i>
                Hapus
              </button>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <button class="btn btn-primary btn-next-form w-full" id="submitHumas" type='button'>Update</button>
  </div>


</form>

@push('js')
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
  {{-- Script for add another humas --}}
  <script>
    const buttonHumas = document.querySelector('.btn-tambah-humas')
    const humasList = document.querySelector('.humas-wrapper-list')
    const firstHumas = document.querySelector('.humas-wrapper')

    buttonHumas.addEventListener('click', function() {
      console.log(humasList.children.length);
      const newInput = `
         <div class="humas-wrapper">
          <label for="name" class="form-label d-block text-left text-lg">Humas ${humasList.children.length+1}</label>
          <div class="form-button d-flex w-full items-center">
            <div class="form-wrapper d-flex w-3/4 flex-col pr-5">
              <div class="form-group text-left">
                <label for="nama_humas[]" class="form-label text-left text-sm">Nama Humas</label>
                <input type="text" class="form-control" name='nama_humas[]' id="nama_humas[]" autofocus='true'
                  placeholder="Masukan Nama Humas">
              </div>
              <div class="form-group text-left">
                <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp Humas</label>
                <input type="text" class="form-control" name='no_wa[]' id='no_wa[]' autofocus='true'
                  placeholder="628xxxxxxxxxx" onpaste="return validatePhone(this);"
                  oninput="return validatePhone(this)";>
                      </div>
                    </div>
                    <button class="btn
                  btn-outline-danger btn-hapus-humas d-block h-fit w-1/4" type='button' onclick="return deleteHumas(this);">
                <i class="fa-solid fa-times mr-2"></i>
                Hapus
                </button>
              </div>
            </div>
          </div>
        </div>
        `;
      humasList.insertAdjacentHTML('beforeend', newInput);

    })
    const deleteHumas = (button) => {
      console.log(button);
      button.closest('.humas-wrapper').remove();
    }
  </script>

  {{-- Post Deskripsi Humas --}}
  <script>
    const postFormHumas = () => {
      const namaHumasList = document.querySelectorAll('[name="nama_humas[]"]')
      const noHumasList = document.querySelectorAll('[name="no_wa[]"]')

      let nama;
      let nomor;
      let grup;
      const wa_grup = document.querySelector('[type="url"]')
      if (wa_grup.value.length == 0) {
        wa_grup.classList.add('is-invalid')
        wa_grup.classList.remove('is-valid')
        wa_grup.focus()
        grup = false;
      } else {
        wa_grup.classList.remove('is-invalid')
        wa_grup.classList.add('is-valid')
        grup = true;
      }

      namaHumasList.forEach(function(item, index) {
        if (item.value.length == 0) {
          item.classList.add('is-invalid')
          item.classList.remove('is-valid')
          item.focus();
          nama = false;
        } else {
          item.classList.remove('is-invalid')
          item.classList.add('is-valid')
          nama = true;
        }
      })

      noHumasList.forEach(function(item, index) {
        if (item.value.length == 0) {
          item.classList.add('is-invalid')
          item.classList.remove('is-valid')
          item.focus();
          nomor = false;

        } else {
          item.classList.remove('is-invalid')
          item.classList.add('is-valid')
          nomor = true;

        }
      })

      return nama && grup && nomor != false ? true : false;

    }

    const postHumas = () => {
      const endpoint = "{{ route('admin_events_update_humas', $event->uuid) }}";

      if (!postFormValidation()) {
        return stepper3.to(1);
      }

      if (!postFormDescription()) {
        return stepper3.previous();
      }

      if (postFormHumas()) {
        const form = document.querySelector('#formStepHumas');
        const formData = new FormData(form);
        let data = {};

        const wa_grup = document.querySelector('[type="url"]')
        const humasList = []

        for (let i = 0; i < formData.getAll('nama_humas[]').length; i++) {
          let Humas = new Object();
          Humas.nama_humas = formData.getAll('nama_humas[]')[i];
          Humas.no_wa = formData.getAll('no_wa[]')[i];
          humasList.push(Humas);
        }

        Swal.fire({
          title: 'Apakah Humas Sudah Benar ?',
          text: "Humas akan diupdate ke dalam sistem",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          heightAuto: false,
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.put(endpoint, {
                humasList,
                'uuid_event': uuidEvent,
                'wa_grup': wa_grup.value
              })
              .then(function(response) {
                if (response.data.success || response.statusCode === 201) {
                  window.scrollTo(0, 0);
                  setTimeout(() => {
                    stepper3.next();
                  }, 100);
                } else {
                  if (response.statusCode === 404 || response.statusCode === 500) {
                    Swal.fire({
                      title: 'Event Belum Disimpan',
                      text: "Mohon simpan terlebih dahulu event pada tab Informasi",
                      icon: 'error',
                    })
                  } else {
                    alert('Something went wrong');
                  }
                }
              })
              .catch(function(error) {
                window.scrollTo(0, 0);

                Swal.fire({
                  title: 'Terjadi Kesalahan',
                  text: "Terjadi kesalahan saat menyimpan deskripsi event",
                  icon: 'warning',
                })
              });
          }
        })


      }
    }


    const buttonSubmitHumas = document.querySelector('#submitHumas');
    buttonSubmitHumas.addEventListener('click', function(e) {
      e.preventDefault();
      postHumas();
    })
  </script>
@endpush
