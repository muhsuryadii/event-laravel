<x-app-layout>
  @push('head')
    <!-- MDB -->
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet" />
    <style>
      .step-trigger {
        padding: 10px !important;
        width: min-content;
      }

      .active .bs-stepper-label {
        color: #007bff;
      }
    </style>
  @endpush

  <div class="row mb-5">
    <div class="col-12">
      <div class="card mb-4 p-4">
        <div id="stepper3" class="bs-stepper">
          <div class="bs-stepper-header" role="tablist">

            {{-- Step Informasi --}}
            <div class="step active" data-target="#informasi">
              <button type="button" class="step-trigger" role="tab" id="stepper3trigger1" aria-controls="informasi"
                aria-selected="false">
                <span class="bs-stepper-circle">
                  <span class="fa-solid fa-info" aria-hidden="true"></span>
                </span>
                <span class="bs-stepper-label">Informasi</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>

            {{-- Step Deskripsi --}}
            <div class="step" data-target="#deskripsi">
              <button type="button" class="step-trigger" role="tab" id="stepper3trigger2" aria-controls="deskripsi"
                aria-selected="true">
                <span class="bs-stepper-circle">
                  <span class="fa-solid fa-align-justify" aria-hidden="true"></span>
                </span>
                <span class="bs-stepper-label">Deskripsi</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>

            {{-- Step Humas --}}
            <div class="step" data-target="#humas">
              <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="humas"
                aria-selected="false">
                <span class="bs-stepper-circle">
                  <span class="fa-brands fa-whatsapp" aria-hidden="true"></span>
                </span>
                <span class="bs-stepper-label">Humas</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>

            {{-- Step Pamflet --}}
            <div class="step" data-target="#pamflet">
              <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="pamflet"
                aria-selected="false">
                <span class="bs-stepper-circle">
                  <span class="fa-regular fa-file-image" aria-hidden="true"></span>
                </span>
                <span class="bs-stepper-label">Pamflet</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>

            {{-- Step Sertifikat --}}
            <div class="step" data-target="#sertifikat">
              <button type="button" class="step-trigger" role="tab" id="stepper3trigger3"
                aria-controls="sertifikat" aria-selected="false">
                <span class="bs-stepper-circle">
                  <span class="fa-solid fa-certificate" aria-hidden="true"></span>
                </span>
                <span class="bs-stepper-label">Sertifikat</span>
              </button>
            </div>


          </div>

          {{-- Form Create Event --}}
          {{-- <form action='{{ route('admin_events_store') }}' method="POST" enctype="multipart/form-data"
            class="p-[1.5rem]" id="formCreateEvent">
            @csrf --}}
          {{-- Stepper Content --}}
          <div class="bs-stepper-content">

            {{-- Tab Informasi --}}
            <div id="informasi" role="tabpanel" class="bs-stepper-pane fade active dstepper-block"
              aria-labelledby="stepper3trigger1">
              <form action='{{ route('admin_events_store_information') }}' method="POST" class="p-[1.5rem]"
                id="formStepInformation">
                @csrf
                {{-- Penyelenggara Event --}}
                <div class="mb-4">
                  <div class="form-group">
                    <label for="id_penyelenggara_event" class="form-label text-sm"
                      value="{{ old('penyelenggara_event') }}">Penyelenggara Event <span
                        class="text-xxs text-danger">(*)</span>
                    </label>

                    <input disabled type="text"
                      class="form-control @error('penyelenggara_event') is-invalid @enderror"
                      value="{{ $user->nama_user }}" id="penyelenggara_event" name='penyelenggara_event'>

                    <input hidden type="text" class="form-control d-none" value={{ $user->id }}
                      id="id_penyelenggara_event" name='id_penyelenggara_event'>

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
                    <input type="text" class="form-control @error('nama_event') is-invalid @enderror"
                      id="nama_event" name='nama_event' autofocus='true' required value="{{ old('nama_event') }}"
                      placeholder="Masukan Nama Event">

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

                    <input type="datetime-local" class="form-control @error('waktu_acara') is-invalid @enderror"
                      id="waktu_acara" name="waktu_acara" required onclick="this.showPicker()"
                      value="{{ old('waktu_acara') }}">

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
                          <input class="form-check-input ticketPrice" type="radio" name="harga_tiket"
                            value='gratis' id="priceFree" checked>
                        @else
                          <input class="form-check-input ticketPrice" type="radio" name="harga_tiket"
                            value='gratis' id="priceFree" {{ old('harga_tiket') === 'gratis' ? 'checked' : ' ' }}>
                        @endif

                        <label class="custom-control-label py-1 px-2" for="priceFree">Gratis</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input ticketPrice" type="radio" name="harga_tiket" value='bayar'
                          id="picePay" required
                          {{ old('harga_tiket') === null ? ' ' : (old('harga_tiket') !== 'gratis' ? 'checked' : ' ') }}>
                        <label class="custom-control-label py-1 px-1" for="picePay">Bayar</label>
                      </div>
                    </div>
                  </div>
                  <div id='inputPriceWrapper'
                    class="input-group {{ old('harga_tiket') === null ? 'd-none' : (old('harga_tiket') !== 'gratis' ? '' : 'd-none') }} mb-4">
                    <span class="input-group-text">Rp. </span>
                    <input class="form-control @error('harga_tiket') is-invalid @enderror" type="number"
                      placeholder="Masukan harga tiket" pattern="[0-9]" name="harga_tiket_bayar"
                      @if (old('harga_tiket') === null) disabled
                                        @else
                                            @if (old('harga_tiket') !== 'gratis')
                                                value="{{ (int) old('harga_tiket_bayar') }}"
                                            @else
                                                disabled @endif
                      @endif

                    >
                  </div>
                  {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket' autofocus='true'> --}}

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
                    <input type="number" class="form-control @error('kuota_tiket') is-invalid @enderror"
                      id="kuota_tiket" name='kuota_tiket' autofocus='true' required
                      value="{{ old('kuota_tiket') }}" placeholder="Masukan Kuota Tiket">

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
                    <label for="name" class="form-label @error('tipe_acara') is-invalid @enderror text-sm">Tipe
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
                          {{ old('lokasi_acara_online') === null ? 'selected ' : (old('lokasi_acara_online') === 'Zoom' ? 'selected' : '') }}>
                          Zoom</option>
                        <option value="Google Meet"
                          {{ old('lokasi_acara_online') === null ? ' ' : (old('lokasi_acara_online') === 'Google Meet' ? 'selected' : '') }}>
                          Google Meet</option>
                        <option value="Lainnya"
                          {{ old('lokasi_acara_online') === null ? ' ' : (old('lokasi_acara_online') !== 'Google Meet' && old('lokasi_acara_online') !== 'Zoom' ? 'selected' : '') }}>
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

                <button class="btn btn-primary btn-next-form" id="submitInformation" type='button'>Next</button>
              </form>
            </div>

            {{-- Tab Dekskripsi --}}
            <div id="deskripsi" role="tabpanel" class="bs-stepper-pane fade dstepper-block dstepper-none"
              aria-labelledby="stepper3trigger2">
              {{-- Deskripsi Event --}}
              <div class="mb-4">
                <div class="form-group">
                  <label for="deskripsi_acara" class="form-label text-sm">Deskripsi Event
                    <span class="text-xxs text-danger">(*)</span>
                  </label>
                  <textarea rows="10" class="form-control @error('deskripsi_acara') is-invalid @enderror mb-5"
                    name='deskripsi_acara' autofocus='true' required="required" value="{{ old('deskripsi_acara') }}"
                    id="ckeditor" placeholder="Masukan Deskripsi Event"> {{ old('deskripsi_acara') }}</textarea>

                  @error('deskripsi_acara')
                    <div id="deskripsi_acara_feedback" class="invalid-feedback">
                      @if (isset($message) && $message == 'validation.required')
                        Deskripsi Event Wajib Diisi
                      @endif
                    </div>
                  @enderror
                </div>
              </div>
              <button class="btn btn-primary btn-next-form" type='button'>Next</button>
            </div>

            {{-- Tab Humas --}}
            <div id="humas" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">


              <div class="mb-4">
                <button class="btn btn-outline-primary btn-tambah-humas d-block ml-auto active:bg-blue-100"
                  type='button'>
                  <i class="fa-solid fa-plus mr-2"></i>
                  Tambah Humas
                </button>
                <div class="humas-wrapper-list">
                  <div class="humas-wrapper">
                    <label for="name" class="form-label d-block text-left text-lg">Humas 1</label>
                    <div class="form-group text-left">
                      <label for="nama_humas[]" class="form-label text-left text-sm">Nama Humas</label>
                      <input type="text" class="form-control @error('nama_humas[]') is-invalid @enderror"
                        name='nama_humas[]' id="nama_humas[]" autofocus='true' value="{{ old('nama_humas[]') }}"
                        placeholder="Masukan Nama Humas">
                      @error('nama_humas[]')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group text-left">
                      <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp Humas</label>
                      <input type="text" class="form-control @error('no_wa[]') is-invalid @enderror"
                        name='no_wa[]' id='no_wa[]' autofocus='true' value="{{ old('no_wa[]') }}"
                        placeholder="628xxxxxxxxxx"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^]/, '628');">
                      @error('no_wa[]')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary btn-next-form" type='button'>Next</button>
              </div>
            </div>

            {{-- Tab Pamflet / Poster --}}
            <div id="pamflet" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">

              <div class="mb-3">
                {{-- <label for="image" class="form-label text-lg">Poster Event</label> --}}
                <img class="img-preview img-fluid col-sm-5 d-block mx-auto mt-3 mb-3 rounded-md shadow-md"
                  src="{{ asset('image/event_image_default.png') }}" loading="lazy">
                <input class="form-control @error('famplet_acara_path') is-invalid @enderror" type="file"
                  id="image" name="image" onchange="previewImage()">

                @error('famplet_acara_path')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

                @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <button class="btn btn-primary btn-next-form" type='button'>Next</button>
            </div>
            {{-- Tab Sertifikat --}}
            <div id="sertifikat" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">
              <button class="btn btn-primary btn-next-form" type='button'>Next</button>
            </div>
          </div>

          <button class="btn btn-primary w-100 btn-simpan mb-4" id="buttonSimpanEvent">Simpan</button>

          {{-- </form> --}}
        </div>
      </div>
    </div>
  </div>


  @push('js')
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

    {{-- Script for preview image --}}
    <script>
      function previewImage() {
        const image = document.querySelector('#image');
        const imagePreview = document.querySelector('.img-preview');

        const reader = new FileReader();

        reader.readAsDataURL(image.files[0]);

        reader.onload = function() {
          imagePreview.src = reader.result;
        }
      }
    </script>

    {{-- CK editor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
      ClassicEditor
        .create(document.querySelector('#ckeditor'), {
          removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'CKTable', 'EasyImage', 'Image',
            'ImageCaption', 'ImageStyle',
            'ImageToolbar', 'ImageUpload', 'MediaEmbed', 'insertTable '
          ],
        })
        .then(editor => {
          console.log(editor);
        })
        .catch(error => {
          console.error(error);
        });
    </script>

    {{-- Sweet alert --}}
    <script>
      const btnSimpan = document.querySelector('#buttonSimpanEvent');

      btnSimpan.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Testing');
        Swal.fire({
          title: 'Apakah Data Sudah Benar ?',
          icon: 'question',
          showDenyButton: true,
          confirmButtonText: 'Sudah, Simpan!',
          denyButtonText: `Belum`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            // Swal.fire('Event Tersimpan!', '', 'success');
            document.getElementById('formCreateEvent').submit();
          }
        })
      })
    </script>


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

    {{-- Stepper --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script>
      let stepper3
      stepper3 = new Stepper(document.querySelector('#stepper3'), {
        linear: false,
        animation: true
      });

      const tabpanelfirst = document.querySelector('#informasi')
      tabpanelfirst.classList.remove('dstepper-none')

      const btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
      btnNextList.forEach(function(btn) {
        btn.addEventListener('click', function() {
          console.log(btnNextList.indexOf(btn))
          setTimeout(() => {
            window.scrollTo(0, 0);
          }, 100);
          stepper3.next();
        })
      })
      //   document.addEventListener('DOMContentLoaded', function() {
      //   })
    </script>

    {{-- contoh stepper script --}}
    {{-- <script>
      var stepper1
      var stepper2
      var stepper3
      var stepper4
      var stepperForm

      document.addEventListener('DOMContentLoaded', function() {
        stepper1 = new Stepper(document.querySelector('#stepper1'))
        stepper2 = new Stepper(document.querySelector('#stepper2'), {
          linear: false
        })
        stepper3 = new Stepper(document.querySelector('#stepper3'), {
          linear: false,
          animation: true
        })
        stepper4 = new Stepper(document.querySelector('#stepper4'))

        var stepperFormEl = document.querySelector('#stepperForm')
        stepperForm = new Stepper(stepperFormEl, {
          animation: true
        })

        var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
        var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
        var inputMailForm = document.getElementById('inputMailForm')
        var inputPasswordForm = document.getElementById('inputPasswordForm')
        var form = stepperFormEl.querySelector('.bs-stepper-content form')

        btnNextList.forEach(function(btn) {
          btn.addEventListener('click', function() {
            stepperForm.next()
          })
        })

        stepperFormEl.addEventListener('show.bs-stepper', function(event) {
          form.classList.remove('was-validated')
          var nextStep = event.detail.indexStep
          var currentStep = nextStep

          if (currentStep > 0) {
            currentStep--
          }

          var stepperPan = stepperPanList[currentStep]

          if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length) ||
            (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
            event.preventDefault()
            form.classList.add('was-validated')
          }
        })
      })
    </script> --}}
    {{-- End Stepper --}}

    {{-- Axios --}}

    <script>
      const postInformation = () => {
        const form = document.querySelector('#formStepInformation');
        const formData = new FormData(form);

        axios.post('/admin/events/create', {
            formData
          })
          .then(function(response) {
            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      const buttonInformation = document.querySelector('#submitInformation');
      buttonInformation.addEventListener('click', function(e) {
        e.preventDefault();
        postInformation();
      })
    </script>

    {{-- Script for add another humas --}}
    <script>
      const buttonHumas = document.querySelector('.btn-tambah-humas')
      const humasList = document.querySelector('.humas-wrapper-list')
      const firstHumas = document.querySelector('.humas-wrapper')

      buttonHumas.addEventListener('click', function() {
        console.log(humasList.children.length);
        humasList.innerHTML += `
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
                placeholder="628xxxxxxxxxx"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^]/, '628');">
            </div>
        </div>
        `;
      })
    </script>
  @endpush

</x-app-layout>
