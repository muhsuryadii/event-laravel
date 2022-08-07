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
      <div class="dashboard-item w-full text-center md:w-1/3">
        <a class="nav-link" href="{{ route('admin_events_index') }}">
          <div
            class="animate mx-auto flex h-[7rem] w-[7rem] items-center justify-center rounded-full bg-rose-500 p-4 text-center text-white hover:bg-rose-400 active:bg-rose-600">
            <i class="ni ni-calendar-grid-58 text-4xl"></i>
          </div>
        </a>
        <h3 class="text-lg font-semibold text-slate-600">Event</h3>
        <p class="px-3 py-2 text-sm capitalize">
          Berfungsi Untuk Membuat Event Baru Yang Ingin Di Buat Oleh Panitia
        </p>
      </div>
      <div class="dashboard-item w-full text-center md:w-1/3">
        <a class="nav-link" href="{{ route('admin_transaksi_index') }}">
          <div
            class="animate mx-auto flex h-[7rem] w-[7rem] items-center justify-center rounded-full bg-emerald-600 p-4 text-center text-white hover:bg-emerald-400 active:bg-emerald-600">
            <i class="ni ni-credit-card text-4xl"></i>
          </div>
        </a>
        <h3 class="text-lg font-semibold text-slate-600">Pembayaran</h3>
        <p class="px-3 py-2 text-sm capitalize">

          Berfungsi Untuk Validasi Pembayaran Peserta Pada Acara Yang Berjalan
        </p>
      </div>
      <div class="dashboard-item w-full text-center md:w-1/3">
        <a class="nav-link" href="{{ route('admin_report_index') }}">
          <div
            class="animate mx-auto flex h-[7rem] w-[7rem] items-center justify-center rounded-full bg-sky-600 p-4 text-center text-white hover:bg-sky-400 active:bg-sky-600">
            <i class="ni ni-calendar-grid-58 text-4xl"></i>
          </div>
        </a>
        <h3 class="text-lg font-semibold text-slate-600">Laporan</h3>
        <p class="px-3 py-2 text-sm capitalize">
          Berfungsi Untuk Melihat Laporan Data Peserta Yang Mengikuti Event, Melihat Absensi Peserta dan Mendownload
          Laporan Data Event
        </p>
      </div>
    </div>
  </div>
</div>

{{-- <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">Documentation</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Laravel has wonderful documentation covering every aspect of the framework. Whether you're new to the framework or have previous experience, we recommend reading all of the documentation from beginning to end.
            </div>

            <a href="https://laravel.com/docs">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Explore the documentation</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laracasts.com">Laracasts</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
            </div>

            <a href="https://laracasts.com">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Start watching Laracasts</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://tailwindcss.com/">Tailwind</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that doesn't get in your way. You'll be amazed how easily you can build and maintain fresh, modern designs with this wonderful framework at your fingertips.
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Authentication</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started what matters most: building your application.
            </div>
        </div>
    </div>
</div> --}}
