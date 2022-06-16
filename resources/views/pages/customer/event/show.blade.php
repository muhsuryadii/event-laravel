<x-app-costumer-layout>

    <section>

        <div class='mt-[3.3rem]'>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-fluid  mx-auto d-block shadow-md rounded-xl"
                            src="{{ $event->famplet_acara_path != null ? asset('storage/' . $event->famplet_acara_path) : asset('image/event_image_default.png') }}"
                            loading="lazy">
                    </div>
                    <div class="col-lg-8">
                        <h3 class="text-3xl leading-normal">{{ $event->nama_event }}</h3>
                    </div>
                </div>


            </div>
        </div>

    </section>

</x-app-costumer-layout>
