  <form action='{{ route('admin_events_update_certificate', $event->uuid) }}' enctype="multipart/form-data" method="POST"
    class="mt-3" id="formStepCertificate">
    @csrf
    @method('put')

    <div class="sertifikat-display">
      <div class="output">
        <canvas id="canvas" width="800" height="550">
          Yahh! Browser kamu engga mendukung. Coba dengan browser
          lainnya.
        </canvas>
        <div class="draggable-file">
          <input id="inputFile" type="file" class="draggable-file-input" name='file' style="opacity: 0"
            accept="image/*" />

          <label class="draggable-file-label" for="inputFile">
            <span class="icon-file">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64" height="64">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M5 11.1l2-2 5.5 5.5 3.5-3.5 3 3V5H5v6.1zm0 2.829V19h3.1l2.986-2.985L7 11.929l-2 2zM10.929 19H19v-2.071l-3-3L10.929 19zM4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm11.5 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"
                  fill="rgba(103,103,103,1)" />
              </svg>
            </span>
            <p>Tarik gambar sertifikat ke sini</p>
          </label>
        </div>
      </div>
      <div class="info-section output max-w-[750px] !justify-start">
        <p>
          <small class="my-2 mb-2 text-sm font-semibold text-slate-800">Jika sertifikat belum siap, bisa
            dikosongkan terlebih dahulu</small>
        </p>
      </div>
    </div>

    {{-- Image Control --}}
    <div class="sertifikat-layout-control my-5 hidden">
      <h4>Pengaturan Layout Sertifikat</h4>

      <div class="input container text-left">
        <button type="button" class="btn btn-danger btn-reset d-block ml-auto">
          <i class="fa-solid fa-rotate-right"></i>
          Reset
        </button>
        <!-- Font Selection -->
        <div style="margin: 20px 0px">
          <label for="">Font</label>
          <select id="select-font" class="select form-control" name="font">
            <option value="times New Roman" selected="selected">
              Times New Roman
            </option>
            <option value="arial">Arial</option>
            <option value="sans">PT Sans</option>
          </select>
        </div>

        <!-- Position Selection -->
        <div style="margin: 20px 0px">
          <label class="text-lg">Posisi Nama</label>

          <div class="slider">
            <label for="vertical" class="text-base" style="margin-right: 8px">Vertikal</label>
            <div class="input-right inline-flex">
              <input type="range" min="0" max="550" step="5"
                value="{{ $event->is_certificate_ready ? $sertifikat->y_coordinate_name : 200 }}" id="vertical"
                style="margin: 0 8px 0 0" />
              <input type="number" class="form-control" min="0" max="550" step="5"
                value="{{ $event->is_certificate_ready ? $sertifikat->y_coordinate_name : 200 }}" id="vertical-input"
                name="yCoordinate" />
            </div>
          </div>

          <div class="slider">
            <label for="horizontal" class="text-base" style="margin-right: 8px">Horizontal</label>
            <div class="input-right inline-flex">
              <input type="range" min="0" max="800" step="5" id="horizontal"
                style="margin-right: 8px"
                value="{{ $event->is_certificate_ready ? $sertifikat->x_coordinate_name : 400 }}" />
              <input type="number" class="form-control" min="0" max="800" step="5"
                id="horizontal-input" value="{{ $event->is_certificate_ready ? $sertifikat->x_coordinate_name : 400 }}"
                name="xCoordinate" />
            </div>
          </div>
        </div>

        <!-- Font size Selection -->
        <div style="margin: 20px 0px">
          <label for="">Ukuran</label>
          <select id="select-font-size" class="select form-control" name="fontsize">
            <option value="14"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 14 ? "selected = 'selected'" : '' }}>Sangat
              kecil</option>
            <option value="16"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 16 ? "selected = 'selected'" : '' }}>Kecil
            </option>
            <option value="20"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 20 ? "selected = 'selected'" : '' }}>Normal
            </option>
            <option value="28"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 28 ? "selected = 'selected'" : '' }}>Medium
            </option>
            <option value="36"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 36 ? "selected = 'selected'" : '' }}>Besar
            </option>
            <option value="60"
              {{ $event->is_certificate_ready && $sertifikat->fontSize == 60 ? "selected = 'selected'" : '' }}>Sangat
              besar</option>
          </select>
        </div>

        <!-- Font Color Selection -->
        <div style="display: flex; align-items: center; margin: 20px 0px">
          <label for="colorPicker" style="margin-right: 8px">Warna</label>
          <input type="color" id="colorPicker" name="color"
            value={{ $event->is_certificate_ready ? $sertifikat->color : '#0f172a ' }} />
        </div>
      </div>
    </div>
    {{-- <button class="btn btn-primary btn-next-form mt-4" type='submit'>Simpan</button> --}}
    <button class="btn btn-primary btn-next-form mt-4" id="submitCertificate" type='button'>Simpan</button>
  </form>

  @push('js')
    <script src="{{ asset('js/watermark.js') }}"></script>

    @if ($event->is_certificate_ready)
      <script>
        async function getFileFromUrl(url, name, defaultType = 'image/jpeg') {
          const response = await fetch(url);
          const data = await response.blob();
          return new File([data], name, {
            type: data.type || defaultType,
          });
        }

        // `await` can only be used in an async body, but showing it here for simplicity.
        async function showImageToCanvas() {
          const file = await getFileFromUrl(
            '{{ asset('storage/' . $sertifikat->certificate_path) }}',
            'example.jpg');

          await reader.readAsDataURL(file);
          draggableFile.style.display = "none";
          controls.style.display = "block";
        }
        showImageToCanvas()
      </script>
    @endif

    {{-- Script for submit sertifikat --}}
    <script>
      const postCertificate = () => {
        const endpoint = "{{ route('admin_events_update_certificate', $event->uuid) }}";

        if (!postFormValidation()) {
          return stepper3.to(1);
        }

        if (!postFormDescription()) {
          return stepper3.to(2);
        }

        const settings = {
          headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }
        const metrics = ctx.measureText(textValue);
        const actualHeight = (metrics.actualBoundingBoxAscent + metrics.fontBoundingBoxAscent);
        const form = document.querySelector('#formStepCertificate');

        let formData = new FormData(form);
        formData.append('uuid_event', uuidEvent);
        formData.append('heightName', actualHeight);

        if (inputFile.files.length == 0 && !reader.result) {
          return window.location = "{{ route('admin_events_index') }}";
        }

        Swal.fire({
          title: 'Apakah Sertifikat Sudah Benar ?',
          text: "Sertifikat event akan diupdate ke dalam sistem",
          icon: 'question',
          showCancelButton: true,
          heightAuto: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Update!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post(endpoint, formData, settings)
              .then(function(response) {
                if (response.data.success || response.statusCode === 201) {
                  // console.log(response.data);
                  // return window.location = "{{ route('admin_events_index') }}";
                  Swal.fire({
                    title: 'Selamat, Event Berhasil Diupdate!',
                    text: "Event berhasil diupdate, Halaman akan di redirect ke halaman list event",
                    icon: 'success',
                  }).then(() => {
                    setTimeout(() => {
                      window.location = "{{ route('admin_events_index') }}";
                    }, 1500);
                  })
                } else {
                  if (response.statusCode === 404) {
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
                console.log(error);
              });
          }
        })


      }

      const buttonSubmitCertificate = document.querySelector('#submitCertificate');
      buttonSubmitCertificate.addEventListener('click', function(e) {
        e.preventDefault();
        postCertificate();
      })
    </script>
  @endpush
