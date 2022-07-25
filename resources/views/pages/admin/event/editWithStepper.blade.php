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
              @include('pages.admin.event.edit.sertifikat')
            </div>
          </div>

          {{-- </form> --}}
        </div>
      </div>
    </div>
  </div>


  @push('js')
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
          // console.log(btnNextList.indexOf(btn))
          setTimeout(() => {
            window.scrollTo(0, 0);
          }, 100);
        })
      })
    </script>
    {{-- End Stepper --}}

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  @endpush

</x-app-layout>
