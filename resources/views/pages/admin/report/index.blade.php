<x-app-layout>

    <div class="flex flex-wrap flex-row justify-start pb-5 pt-3">
        @if (count($reportEvent) > 0)
            @foreach ($reportEvent as $event)
                <a href="{{ route('admin_report_show', $event->uuid) }}"
                    class="events-card w-full md:w-1/2 lg:w-1/5 p-2 text-slate-600 no-underline ">
                    <div
                        class="bg-white border-2 border-gray-200 rounded-3xl overflow-hidden  h-full content-wrapper shadow-md hover:shadow-lg 
                            transition-all duration-200 ease-in-out">

                        <div class="image-wrapper event-image-wrapper">
                            <img class="mx-auto d-block  w-full h-full object-cover "
                                src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                                loading="lazy">
                        </div>

                        <div class="px-3 py-4  flex flex-col flex-wrap justify-between event-info-wrapper">
                            <div class="event_info w-full">
                                <i class="fa-regular fa-calendar mr-1 text-secondary"></i>
                                <span class="text-secondary text-xs font-weight-bold">
                                    {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}
                                </span>
                                <h3 class="text-base  font-semibold mt-2 line-clamp-2"
                                    title="{{ $event->nama_event }}">
                                    {{ $event->nama_event }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="text-white mt-3">
                <h4 class="alert-heading">Oops!</h4>
                <p>
                    Belum ada lapoaran pada salah satu event yang bisa dilihat.
                </p>
            </div>
        @endif

    </div>
</x-app-layout>
