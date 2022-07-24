  <form action='{{ route('admin_events_store_certificate') }}' method="POST" class="mt-3" id="formStepInformation">
    <div class="output">
      <canvas id="canvas" width="800" height="550">
        Yahh! Browser kamu engga mendukung. Coba dengan browser
        lainnya.
      </canvas>
      <div class="draggable-file">
        <input id="inputFile" type="file" class="draggable-file-input" style="opacity: 0" accept="image/*" />

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

    {{-- Image Control --}}
    <div class="sertifikat-layout-control my-5 hidden">
      <h4>Layout Sertifikat</h4>

      <div class="input container text-left">
        <button type="button" class="btn btn-danger btn-reset d-block ml-auto">
          <i class="fa-solid fa-rotate-right"></i>
          Reset
        </button>
        <!-- Font Selection -->
        <div style="margin: 20px 0px">
          <label for="">Font</label>
          <select id="select-font" class="select form-control">
            <option value="times New Roman" selected="selected">
              Times New Roman
            </option>
            <option value="arial">Arial</option>
            <option value="sans">PT Sans</option>
          </select>
        </div>

        <!-- Position Selection -->
        <div style="margin: 20px 0px">
          <label for="select-position">Posisi</label>
          <select id="select-position" class="select form-control">
            <option value="top" selected="selected">Atas</option>
            <option value="top-left">Atas kiri</option>
            <option value="top-right">Atas kanan</option>
            <option value="center">Tengah</option>
            <option value="center-left">Tengah kiri</option>
            <option value="center-right">Tengah kanan</option>
            <option value="bottom">Bawah</option>
            <option value="bottom-left">Bawah kiri</option>
            <option value="bottom-right">Bawah kanan</option>
          </select>
        </div>

        <!-- Font size Selection -->
        <div style="margin: 20px 0px">
          <label for="">Ukuran</label>
          <select id="select-font-size" class="select form-control">
            <option value="14">Sangat kecil</option>
            <option value="16">Kecil</option>
            <option value="20" selected="selected">Normal</option>
            <option value="36">Besar</option>
            <option value="60">Sangat besar</option>
          </select>
        </div>

        <!-- Font Color Selection -->
        <div style="display: flex; align-items: center; margin: 20px 0px">
          <label for="colorPicker" style="margin-right: 8px">Warna</label>
          <input type="color" id="colorPicker" value="#0f172a" />
        </div>
      </div>
    </div>
    <button class="btn btn-primary btn-next-form mt-4" type='button'>Simpan</button>
  </form>

  @push('js')
    <script src="{{ asset('js/watermark.js') }}"></script>
  @endpush
