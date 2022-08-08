<x-app-layout>

  @if (count($reportEvent) > 0)
    <div class="flex flex-row flex-wrap justify-start pt-3">
      @foreach ($reportEvent as $event)
        <a href="{{ route('admin_report_show', $event->uuid) }}"
          class="events-card w-1/2 p-2 text-slate-600 no-underline lg:w-1/5">
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
                @if (Auth::user()->role == 'ADMIN')
                  <div class="panitia">
                    <i class="fa-solid fa-image-portrait text-secondary mr-1"></i>
                    <span class="text-secondary font-weight-bold text-xs">
                      {{ $event->nama_user }}
                    </span>
                  </div>
                @endif
                <h3 class="line-clamp-2 mt-2 text-base font-semibold" title="{{ $event->nama_event }}">
                  {{ $event->nama_event }}
                </h3>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div class="my-5 px-5 sm:px-3">
      <span>{{ $reportEvent->links() }}</span>
    </div>
  @else
    <div class="mt-3 text-white">
      <h4 class="alert-heading">Oops!</h4>
      <p>
        Belum ada lapoaran pada salah satu event yang bisa dilihat.
      </p>
    </div>
  @endif


</x-app-layout>
