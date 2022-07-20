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

          {{-- Stepper Content --}}
          <div class="bs-stepper-content">

            {{-- Tab Informasi --}}
            <div id="informasi" role="tabpanel" class="bs-stepper-pane fade active dstepper-block"
              aria-labelledby="stepper3trigger1">
              @include('pages.admin.event.edit.informasi')
            </div>

            {{-- Tab Dekskripsi --}}
            <div id="deskripsi" role="tabpanel" class="bs-stepper-pane fade dstepper-block dstepper-none"
              aria-labelledby="stepper3trigger2">
              @include('pages.admin.event.edit.deskripsi')
            </div>

            {{-- Tab Humas --}}
            <div id="humas" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">

              @include('pages.admin.event.edit.humas')
            </div>

            {{-- Tab Pamflet / Poster --}}
            <div id="pamflet" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">
              @include('pages.admin.event.edit.pamflet')
            </div>

            {{-- Tab Sertifikat --}}
            <div id="sertifikat" role="tabpanel" class="bs-stepper-pane fade dstepper-none text-center"
              aria-labelledby="stepper3trigger3">
              <button class="btn btn-primary btn-next-form" type='button'>Next</button>
            </div>
          </div>

          {{-- <button class="btn btn-primary w-100 btn-simpan mb-4" id="buttonSimpanEvent">Simpan</button> --}}

          {{-- </form> --}}
        </div>
      </div>
    </div>
  </div>


  @push('js')
    {{-- Sweet alert --}}
    {{-- <script>
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
    </script> --}}


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
          //   stepper3.next();
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  @endpush

</x-app-layout>
