<x-app-layout>

  <div class="flex flex-row flex-wrap justify-start pb-5 pt-3">
    @if (count($events) > 0)
      @foreach ($events as $event)
        <a href="{{ route('admin_transaksi_show', $event->uuid) }}"
          class="events-card mx-auto w-1/2 p-2 text-slate-600 no-underline lg:w-1/5">
          <div
            class="content-wrapper h-full overflow-hidden rounded-3xl border-2 border-gray-200 bg-white shadow-md transition-all duration-200 ease-in-out hover:shadow-lg">

            <div class="image-wrapper event-image-wrapper">
              <img class="d-block mx-auto h-full w-full object-cover"
                src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                loading="lazy">
            </div>

            <div class="event-info-wrapper flex flex-col flex-wrap justify-between px-3 py-4">
              <div class="event_info w-full">
                <i class="fa-regular fa-calendar text-secondary mr-1"></i>
                <span class="text-secondary font-weight-bold text-xs">
                  {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                </span>
                <h3 class="line-clamp-2 mt-2 text-base font-semibold" title="{{ $event->nama_event }}">
                  {{ $event->nama_event }}
                </h3>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    @else
      <div class="mt-3 text-white">
        <h4 class="alert-heading">Oops!</h4>
        <p>
          Belum ada transaksi pada salah satu event yang dilakukan.
        </p>
      </div>
    @endif

  </div>
</x-app-layout>
