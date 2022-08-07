<div class="border-b border-gray-200 bg-white p-6 sm:px-20">
  <div class='flex items-center'>
    <img src=" {{ asset('image/logo_usni.png') }}" alt="logo" class="mr-3 block w-[100px] lg:w-[150px]" loading="lazy">
    <h1 class="text-3xl text-slate-600 lg:text-4xl">Selamat Datang di Sistem Event USNI</h1>
  </div>

  <div class="mt-5 text-center text-xl font-medium text-slate-500 lg:text-2xl">
    {{-- Selamat Datang di Sistem Event USNI --}}
    Fitur Utama Kami :
  </div>
  <div class="mt-3 text-gray-500">
    <div class="dashboard-wrapper mx-auto flex flex-col flex-wrap lg:flex-row">
      <div class="dashboard-item w-full text-center md:w-1/2">
        <a class="nav-link" href="{{ route('admin_report_index') }}">
          <div
            class="animate mx-auto flex h-[7rem] w-[7rem] items-center justify-center rounded-full bg-sky-500 p-4 text-center text-white hover:bg-sky-400 active:bg-sky-600">
            <i class="ni ni-calendar-grid-58 text-4xl"></i>
          </div>
        </a>
        <h3 class="text-lg font-semibold text-slate-600">Laporan</h3>
        <p class="px-3 py-2 text-sm capitalize">
          Berfungsi Untuk Melihat Laporan Data Peserta Yang Mengikuti Event, Melihat Absensi Peserta dan Mendownload
          Laporan Data Event
        </p>
      </div>
      <div class="dashboard-item w-full text-center md:w-1/2">
        <a class="nav-link" href="{{ route('admin_panitia_index') }}">
          <div
            class="animate mx-auto flex h-[7rem] w-[7rem] items-center justify-center rounded-full bg-emerald-500 p-4 text-center text-white hover:bg-emerald-400 active:bg-emerald-600">
            <i class="fa-solid fa-users text-4xl"></i>
          </div>
        </a>
        <h3 class="text-lg font-semibold text-slate-600">Panitia</h3>
        <p class="px-3 py-2 text-sm capitalize">
          Berfungsi Untuk Mengelola Data Panitia, Hanya panitia yang dapat mendaftarkan event
        </p>
      </div>

    </div>
  </div>
</div>
