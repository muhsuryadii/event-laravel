  <form action='{{ route('admin_events_store_info') }}' method="POST" class="p-[1.5rem]" id="formStepInformation">
    @csrf
    {{-- Penyelenggara Event --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="id_penyelenggara_event" class="form-label text-sm"
          value="{{ old('penyelenggara_event') }}">Penyelenggara Event <span class="text-xxs text-danger">(*)</span>
        </label>

        <input disabled type="text" class="form-control @error('penyelenggara_event') is-invalid @enderror"
          value="{{ $user->nama_user }}" id="penyelenggara_event" name='penyelenggara_event'>

        <input hidden type="text" class="form-control d-none" value={{ $user->id }} id="id_penyelenggara_event"
          name='id_penyelenggara_event'>
        <input hidden type="hidden" class="form-control d-none" id="uuid_event" name='uuid_event'>

        @error('penyelenggara_event')
          <div id="penyelenggara_event_feedback" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

    </div>

    {{-- Nama Event --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="nama_event" class="form-label text-sm">Nama
          Event <span class="text-xxs text-danger">(*)</span> </label>
        <input type="text" class="form-control @error('nama_event') is-invalid @enderror" id="nama_event"
          name='nama_event' autofocus='true' required value="{{ old('nama_event') }}" placeholder="Masukan Nama Event">

        @error('nama_event')
          <div id="nama_event_feedback" class="invalid-feedback">
            @if ($message == 'validation.required')
              Nama Event Wajib Diisi
            @endif
          </div>
        @enderror
      </div>
    </div>
    {{-- Waktu Event --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="waktu_acara" class="form-label text-sm">Tanggal / Waktu Event
          <span class="text-xxs text-danger">(*)</span> </label>

        <input type="datetime-local" class="form-control @error('waktu_acara') is-invalid @enderror" id="waktu_acara"
          name="waktu_acara" required onclick="this.showPicker()" value="{{ old('waktu_acara') }}">

        @error('waktu_acara')
          <div id="datetime_feedback" class="invalid-feedback capitalize">
            @if (isset($message) && $message == 'validation.after_or_equal')
              Mohon Masukan Waktu Event Yang Sesuai
            @elseif (isset($message) && $message == 'validation.required')
              Waktu Event Wajib Diisi
            @else
              {{ $message }}
            @endif
          </div>
        @enderror
      </div>
    </div>

    {{-- Harga Tiket --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="name" class="form-label text-sm" value="{{ old('harga_tiket') }}">Harga
          Tiket</label>

        <div class="radio d-flex mt-3">
          <div class="form-check mb-1 mr-3">
            @if (old('harga_tiket') == null)
              <input class="form-check-input ticketPrice" type="radio" name="harga_tiket" value='gratis'
                id="priceFree" checked>
            @else
              <input class="form-check-input ticketPrice" type="radio" name="harga_tiket" value='gratis'
                id="priceFree" {{ old('harga_tiket') === 'gratis' ? 'checked' : ' ' }}>
            @endif

            <label class="custom-control-label py-1 px-2" for="priceFree">Gratis</label>
          </div>
          <div class="form-check">
            <input class="form-check-input ticketPrice" type="radio" name="harga_tiket" value='bayar' id="picePay"
              required {{ old('harga_tiket') === null ? ' ' : (old('harga_tiket') !== 'gratis' ? 'checked' : ' ') }}>
            <label class="custom-control-label py-1 px-1" for="picePay">Bayar</label>
          </div>
        </div>
      </div>
      <div id='inputPriceWrapper'
        class="input-group {{ old('harga_tiket') === null ? 'd-none' : (old('harga_tiket') !== 'gratis' ? '' : 'd-none') }} mb-4">
        <span class="input-group-text">Rp. </span>
        <input class="form-control @error('harga_tiket') is-invalid @enderror" type="text"
          placeholder="Masukan harga tiket"
          oninput="this.value = this.value.replace(/^[^1-9]/g, '').replace(/[^0-9]/g, '').replace(/[!@#$%^&*]/g, '');"
          name="harga_tiket_bayar"
          @if (old('harga_tiket') === null) disabled @else
            @if (old('harga_tiket') !== 'gratis') value="{{ (int) old('harga_tiket_bayar') }}"
           @else disabled @endif
          @endif>
      </div>
      {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket'
                                            autofocus='true'> --}}

      @error('harga_tiket')
        <div id="ticket_price_feedback" class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Kuota Tiket --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="kuota_tiket" class="form-label text-sm">Kuota
          Tiket <span class="text-xxs text-danger">(*)</span> </label>
        <input type="text" class="form-control @error('kuota_tiket') is-invalid @enderror" id="kuota_tiket"
          name='kuota_tiket' autofocus='true' required value="{{ old('kuota_tiket') }}"
          placeholder="Masukan Kuota Tiket"
          oninput="this.value = this.value.replace(/^[^1-9]/g, '').replace(/[^0-9]/g, '').replace(/[!@#$%^&*]/g, '');">

        @error('kuota_tiket')
          <div id="kuota_tiket_feedback" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

    </div>

    {{-- Tipe Acara --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="name" class="form-label @error('tipe_acara') is-invalid @enderror text-sm">Lokasi
          Event</label>
        <div class="radio d-flex mt-3">
          <div class="form-check mb-3 mr-3">
            <input class="form-check-input eventType" type="radio" name="tipe_acara" value='online'
              id="online"
              {{ old('tipe_acara') === null ? 'checked' : (old('tipe_acara') == 'online' ? 'checked' : ' ') }}>
            <label class="custom-control-label py-1 px-2" for="online">Online</label>
          </div>
          <div class="form-check">
            <input class="form-check-input eventType" type="radio" name="tipe_acara" value='offline'
              id="offline"
              {{ old('tipe_acara') === null ? ' ' : (old('tipe_acara') == 'offline' ? 'checked' : ' ') }}>
            <label class="custom-control-label py-1 px-1" for="offline">Offline</label>
          </div>
        </div>

        @error('tipe_acara')
          <div id="deskripsi_acara_feedback" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror


        <div id='eventOnline'
          class="input-group event-location-input {{ old('tipe_acara') === null ? ' ' : (old('tipe_acara') === 'online' ? '' : 'd-none') }} mb-4">
          <select class="form-select @error('lokasi_acara_online') is-invalid @enderror"
            aria-label="Default select example" name="lokasi_acara_online">

            <option value="Zoom"
              {{ old('lokasi_acara_online') === null
                  ? 'selected '
                  : (old('lokasi_acara_online') === 'Zoom'
                      ? 'selected'
                      : '') }}>
              Zoom</option>
            <option value="Google Meet"
              {{ old('lokasi_acara_online') === null ? ' ' : (old('lokasi_acara_online') === 'Google Meet' ? 'selected' : '') }}>
              Google Meet</option>
            <option value="Lainnya"
              {{ old('lokasi_acara_online') === null
                  ? ' '
                  : (old('lokasi_acara_online') !== 'Google Meet' && old('lokasi_acara_online') !== 'Zoom'
                      ? 'selected'
                      : '') }}>
              Lainnya</option>
          </select>

          @error('lokasi_acara_online')
            <div id="lokasi_acara_offline_feedback" class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div id='eventOffline'
          class="input-group event-location-input {{ old('tipe_acara') === null ? ' d-none' : (old('tipe_acara') === 'online' ? 'd-none' : ' ') }} mb-4">
          <div class="w-100 mb-4">
            <input type="text" class="form-control @error('lokasi_acara_offline') is-invalid @enderror"
              id="lokasi_acara_offline" name='lokasi_acara_offline' autofocus='true'
              value="{{ old('lokasi_acara_offline') }}" placeholder="Masukan Lokasi Event" disabled>

            @error('lokasi_acara_offline')
              <div id="lokasi_acara_offline_feedback" class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>
      </div>

    </div>

    <button class="btn btn-primary btn-next-form w-full" id="submitInformation" type='button'>Simpan</button>
  </form>

  @push('js')
    {{-- uuid --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"
      integrity="sha512-UNM1njAgOFUa74Z0bADwAq8gbTcqZC8Ej4xPSzpnh0l6KMevwvkBvbldF9uR++qKeJ+MOZHRjV1HZjoRvjDfNQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
      const grenateUUID = () => {
        const newUuid = uuid.v4()
        return newUuid.replace(/-/g, "");
      }
    </script>

    {{-- Script for Event price toogle --}}
    <script>
      const radioPrice = document.querySelectorAll('input[type=radio][name=harga_tiket]');
      const inputPriceWrapper = document.getElementById('inputPriceWrapper');
      radioPrice.forEach(function(radio) {
        radio.addEventListener('click', function() {
          inputPriceWrapper.classList.remove('d-none');

          if (radio.value === 'gratis') {
            inputPriceWrapper.classList.add('d-none');
            inputPriceWrapper.querySelector('input').value = '';
            inputPriceWrapper.querySelector('input').setAttribute('disabled', true);


          } else {
            inputPriceWrapper.classList.remove('d-none');
            inputPriceWrapper.querySelector('input').removeAttribute('disabled');

          }
        });
      });
    </script>

    {{-- Script for Event Type toogle --}}
    <script>
      const radioEventType = document.querySelectorAll('input[type=radio][name=tipe_acara]');
      const locationInput = document.querySelectorAll('.event-location-input');
      radioEventType.forEach(function(radio) {
        radio.addEventListener('click', function() {

          locationInput.forEach(function(input) {
            // console.log(input)
            input.classList.remove('d-none');
          });


          if (radio.value === 'online') {

            locationInput[1].classList.add('d-none');
            locationInput[1].querySelector('input').value = '';
            locationInput[1].querySelector('input').setAttribute('disabled', true);
            locationInput[0].querySelector('select').removeAttribute('disabled')

          } else {
            locationInput[1].querySelector('input').removeAttribute('disabled');

            locationInput[0].classList.add('d-none');
            locationInput[0].querySelector('select').setAttribute('disabled', true)

          }
        });
      });
    </script>
    {{-- Script for date validation --}}
    <script>
      const waktu_acara = document.getElementById("waktu_acara");
      const date = new Date();
      const isoDateTime = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString();
      const now = isoDateTime.split('.')[0];
      waktu_acara.setAttribute("min", now.substr(0, 16));
    </script>

    {{-- script for uuid event --}}
    <script>
      const uuidElement = document.querySelector('#uuid_event');
      uuidElement.value = grenateUUID();
      const uuidEvent = uuidElement.value
    </script>

    {{-- Post Event Information --}}
    <script>
      const postFormValidation = () => {
        const namaEvent = document.querySelector('#nama_event');
        const waktuEvent = document.querySelector('#waktu_acara');
        const kuota_tiket = document.querySelector('#kuota_tiket');
        let hargaTiket = document.querySelector('[name="harga_tiket"]:checked');
        let tipeEvent = document.querySelector('[name="tipe_acara"]:checked');

        if (namaEvent.value.length == 0) {
          namaEvent.classList.add('is-invalid');
          namaEvent.classList.remove('is-valid');
          namaEvent.focus();
          return false;
        } else {
          namaEvent.classList.remove('is-invalid');
          namaEvent.classList.add('is-valid');
        }

        if (waktuEvent.value.length == 0) {
          waktuEvent.classList.add('is-invalid');
          waktuEvent.classList.remove('is-valid');
          waktuEvent.focus();
          return false;
        } else {
          waktuEvent.classList.remove('is-invalid');
          waktuEvent.classList.add('is-valid');
        }

        if (kuota_tiket.value.length == 0) {
          kuota_tiket.classList.add('is-invalid');
          kuota_tiket.classList.remove('is-valid');
          kuota_tiket.focus();
          return false;
        } else {
          kuota_tiket.classList.remove('is-invalid');
          kuota_tiket.classList.add('is-valid');
        }

        if (hargaTiket.value === 'bayar') {
          const hargaBayar = document.querySelector('[name="harga_tiket_bayar"]');
          if (hargaBayar.value.length == 0) {
            hargaBayar.classList.add('is-invalid');
            hargaBayar.classList.remove('is-valid');
            hargaBayar.focus();
            return false;
          } else {
            hargaBayar.classList.remove('is-invalid');
            hargaBayar.classList.add('is-valid');
          }
        }
        if (tipeEvent.value === 'offline') {
          const tempatOffline = document.querySelector('#lokasi_acara_offline');
          if (tempatOffline.value.length == 0) {
            tempatOffline.classList.add('is-invalid');
            tempatOffline.classList.remove('is-valid');
            tempatOffline.focus();
            return false;
          } else {
            tempatOffline.classList.remove('is-invalid');
            tempatOffline.classList.add('is-valid');
          }
        }

        return true;

      }

      const postInformation = () => {
        const endpoint = "{{ route('admin_events_store_info') }}";
        if (postFormValidation()) {
          const form = document.querySelector('#formStepInformation');
          const formData = new FormData(form);
          let data = {};

          for (let pair of formData.entries()) {
            Object.assign(data, {
              [pair[0]]: pair[1]
            });
          }

          Swal.fire({
            title: 'Apakah Informasi Sudah Benar ?',
            text: "Informasi event akan disimpan ke dalam sistem",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
          }).then((result) => {
            if (result.isConfirmed) {
              axios.post(endpoint, {
                  ...data
                })
                .then(function(response) {
                  if (response.data.success || response.statusCode === 201) {
                    // console.log(response);
                    stepper3.next();
                  } else {
                    alert('Something went wrong');
                  }
                })
                .catch(function(error) {
                  console.log(error);
                });
            }
          })
        }
      }


      const buttonInformation = document.querySelector('#submitInformation');
      buttonInformation.addEventListener('click', function(e) {
        e.preventDefault();
        postInformation();
      })
    </script>
  @endpush
