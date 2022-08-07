<a href="{{ route('event_show', $event->uuid) }}"
  class="events-card mt-3 w-full p-2 text-slate-600 no-underline md:w-1/2 lg:w-1/5">
  <div
    class="content-wrapper {{ now() >= $event->waktu_acara ? 'grayscale bg-slate-200' : 'bg-white hover:!bg-slate-100' }} h-full overflow-hidden rounded-3xl border-2 border-gray-200 shadow-md transition-all duration-200 ease-in-out hover:shadow-lg">

    <div class="image-wrapper event-image-wrapper">
      <img class="d-block mx-auto h-full w-full object-cover"
        src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
        loading="lazy">
    </div>

    <div class="event-info-wrapper flex flex-col flex-wrap justify-between px-3 py-4">
      <div class="event_info w-full">
        <div class="tanggal-wrapper">

          <i class="fa-regular fa-calendar text-secondary mr-1"></i>
          <span class="text-secondary font-weight-bold text-xs">
            {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
          </span>
        </div>
        <div class="panitia">
          <i class="fa-solid fa-image-portrait text-secondary mr-1"></i>
          <span class="text-secondary font-weight-bold text-xs">
            {{ $event->nama_panitia }}
          </span>
        </div>

        <h3 class="line-clamp-3 mt-2 text-base font-semibold" title="{{ $event->nama_event }}">
          {{ $event->nama_event }}
        </h3>
      </div>

      <div class="event_price">

        @if ($event->harga_tiket == 0)
          <span class='text-base font-bold uppercase text-slate-700'>
            Gratis </span>
        @else
          <span class='text-base font-semibold text-slate-700'>Rp.
            {{ number_format($event->harga_tiket) }}</span>
        @endif
      </div>
    </div>
  </div>
</a>
