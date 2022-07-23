<form action='{{ route('admin_events_store_humas') }}' method="POST" class="p-[1.5rem]" id="formStepHumas">
  @csrf
  <div class="mb-4">
    <button class="btn btn-outline-primary btn-tambah-humas d-block ml-auto active:bg-blue-100" type='button'>
      <i class="fa-solid fa-plus mr-2"></i>
      Tambah Humas
    </button>
    <div class="humas-wrapper-list">
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
            oninput="this.value = this.value.replace(/^[^6]/g, '').replace(/[^0-9.]/g, '').replace(/[!@#$%^&*]/g, '');">
          @error('no_wa[]')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
    </div>

    <button class="btn btn-primary btn-next-form w-full" id="submitHumas" type='button'>Simpan</button>
  </div>
</form>

@push('js')
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
            <div class="form-group text-left">
            <label for="nama_humas[]" class="form-label text-left text-sm">Nama Humas</label>
            <input type="text" class="form-control" name='nama_humas[]' id="nama_humas[]" autofocus='true'
                placeholder="Masukan Nama Humas">
            </div>
            <div class="form-group text-left">
            <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp Humas</label>
            <input type="text" class="form-control" name='no_wa[]' id='no_wa[]' autofocus='true'
                placeholder="628xxxxxxxxxx"  oninput="this.value = this.value.replace(/^[^6]/g, '').replace(/[^0-9.]/g, '').replace(/[!@#$%^&*]/g, '');">
            </div>
        </div>
        `;
      humasList.insertAdjacentHTML('beforeend', newInput);

    })
  </script>

  {{-- Post Deskripsi Humas --}}
  <script>
    const postFormHumas = () => {
      const namaHumasList = document.querySelectorAll('[name="nama_humas[]"]')
      const noHumasList = document.querySelectorAll('[name="no_wa[]"]')

      namaHumasList.forEach(function(item, index) {
        if (item.value.length == 0) {
          item.classList.add('is-invalid')
          item.classList.remove('is-valid')
          item.focus();
          return false;

        } else {
          item.classList.remove('is-invalid')
          item.classList.add('is-valid')
        }
      })

      noHumasList.forEach(function(item, index) {
        if (item.value.length == 0) {
          item.classList.add('is-invalid')
          item.classList.remove('is-valid')
          item.focus();
          return false;

        } else {
          item.classList.remove('is-invalid')
          item.classList.add('is-valid')
        }
      })

      return true;

    }

    const postHumas = () => {
      const endpoint = "{{ route('admin_events_store_humas') }}";

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

        const humasList = []

        for (let i = 0; i < formData.getAll('nama_humas[]').length; i++) {
          let Humas = new Object();
          Humas.nama_humas = formData.getAll('nama_humas[]')[i];
          Humas.no_wa = formData.getAll('no_wa[]')[i];
          humasList.push(Humas);
        }

        axios.post(endpoint, {
            humasList,
            'uuid_event': uuidEvent
          })
          .then(function(response) {
            if (response.data.success || response.statusCode === 201) {
              console.log(response);
              stepper3.next();
            } else {
              alert('Something went wrong');
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      }
    }


    const buttonSubmitHumas = document.querySelector('#submitHumas');
    buttonSubmitHumas.addEventListener('click', function(e) {
      e.preventDefault();
      postHumas();
    })
  </script>
@endpush
