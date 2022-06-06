<x-app-layout>
    {{-- {{ dd($user) }} --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <form action='{{ route('admin_events_store') }}' method="POST" enctype="multipart/form-data"
                    class="p-[1.5rem]">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 col-12">
                            {{-- Penyelenggara Event --}}
                            <div class="mb-4">
                                <label for="id_penyelenggara_event" class="form-label text-sm "
                                    value="{{ old('penyelenggara_event') }}">Penyelenggara <span
                                        class="text-xxs text-danger">(*)</span>
                                </label>

                                <input disabled type="text"
                                    class="form-control @error('penyelenggara_event') is-invalid @enderror"
                                    value="{{ $user->nama_user }}" id="penyelenggara_event"
                                    name='penyelenggara_event'>

                                <input hidden type="text" class="form-control d-none" value={{ $user->id }}
                                    id="id_penyelenggara_event" name='id_penyelenggara_event'>

                                @error('penyelenggara_event')
                                    <div id="penyelenggara_event_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Nama Event --}}
                            <div class="mb-4">
                                <label for="nama_event" class="form-label text-sm ">Nama
                                    Event <span class="text-xxs text-danger">(*)</span> </label>
                                <input type="text" class="form-control @error('nama_event') is-invalid @enderror"
                                    id="nama_event" name='nama_event' autofocus='true' required
                                    value="{{ old('nama_event') }}" placeholder="Masukan Nama Event">

                                @error('nama_event')
                                    <div id="nama_event_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" class="form-control" name="slug" id="slug">
                            </div>

                            {{-- Watku Event --}}
                            <div class="mb-4">
                                <label for="waktu_acara" class="form-label text-sm ">Tanggal / Waktu Event
                                    <span class="text-xxs text-danger">(*)</span> </label>

                                <input type="datetime-local"
                                    class="form-control  @error('waktu_acara') is-invalid @enderror" id="waktu_acara"
                                    name="waktu_acara" required value="{{ old('waktu_acara') }}">

                                @error('waktu_acara')
                                    <div id="datetime_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Harga Tiket --}}
                            <div class="mb-4">
                                <label for="name" class="form-label text-sm " value="{{ old('harga_tiket') }}">Harga
                                    Tiket</label>

                                <div class="radio mt-3 d-flex">
                                    <div class="form-check mb-3 mr-3">
                                        <input class="form-check-input ticketPrice" type="radio" name="harga_tiket"
                                            value='gratis' id="priceFree" checked>
                                        <label class="custom-control-label py-1 px-2" for="priceFree">Gratis</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input ticketPrice" type="radio" name="harga_tiket"
                                            value='bayar' id="picePay" required>
                                        <label class="custom-control-label  py-1 px-1" for="picePay">Bayar</label>
                                    </div>
                                </div>


                                <div id='inputPriceWrapper' class="input-group mb-4 d-none">
                                    <span class="input-group-text">Rp. </span>
                                    <input class="form-control @error('harga_tiket') is-invalid @enderror" type="number"
                                        placeholder="Masukan harga tiket" pattern="[0-9]" name="harga_tiket_bayar"
                                        disabled>
                                </div>
                                {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket' autofocus='true'> --}}

                                @error('harga_tiket')
                                    <div id="ticket_price_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            {{-- poster Event --}}
                            <div class="mb-3">
                                <label for="image" class="form-label text-sm ">Poster Event</label>
                                <img class="img-preview img-fluid mt-3 mb-3 mx-auto col-sm-5 d-block shadow-md rounded-md"
                                    src="{{ asset('image/event_image_default.png') }}" loading="lazy">
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                    name="image" onchange="previewImage()">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    {{-- Kuota Tiket --}}
                    <div class="mb-4">
                        <label for="kuota_tiket" class="form-label text-sm">Kuota
                            Tiket <span class="text-xxs text-danger">(*)</span> </label>
                        <input type="number" class="form-control  @error('kuota_tiket') is-invalid @enderror"
                            id="kuota_tiket" name='kuota_tiket' autofocus='true' required
                            value="{{ old('kuota_tiket') }}" placeholder="Masukan Kuota Tiket">

                        @error('kuota_tiket')
                            <div id="kuota_tiket_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tipe Acara --}}
                    <div class="mb-4">
                        <label for="name" class="form-label text-sm @error('nama_event') is-invalid @enderror">Tipe
                            Event</label>
                        <div class="radio mt-3 d-flex">
                            <div class="form-check mb-3 mr-3">
                                <input class="form-check-input eventType" type="radio" name="tipe_event" value='online'
                                    id="online" checked>
                                <label class="custom-control-label py-1 px-2" for="online">Online</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input eventType" type="radio" name="tipe_event" value='ofline'
                                    id="offline" required>
                                <label class="custom-control-label  py-1 px-1" for="offline">Offline</label>
                            </div>
                        </div>


                        <div id='eventOnline' class="input-group mb-4 event-location-input">
                            <select class="form-select  @error('lokasi_acara_online') is-invalid @enderror"
                                aria-label="Default select example" name="lokasi_acara_online">
                                <option value="Zoom" selected>Zoom</option>
                                <option value="Google Meet">Google Meet</option>
                                <option value="Others">Others</option>
                            </select>

                            @error('lokasi_acara_online')
                                <div id="lokasi_acara_offline_feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id='eventOffline' class="input-group mb-4 event-location-input d-none">
                            <div class="mb-4  w-100">
                                <input type="text"
                                    class="form-control @error('lokasi_acara_offline') is-invalid @enderror"
                                    id="lokasi_acara_offline" name='lokasi_acara_offline' autofocus='true'
                                    value="{{ old('lokasi_acara_offline') }}" placeholder="Masukan Lokasi Event"
                                    disabled>

                                @error('lokasi_acara_offline')
                                    <div id="lokasi_acara_offline_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket' autofocus='true'> --}}


                    </div>

                    {{-- Deskripsi Event --}}
                    <div class="mb-4">
                        <label for="deskripsi_acara" class="form-label text-sm ">Deskripsi Event
                            <span class="text-xxs text-danger">(*)</span>
                        </label>
                        <textarea rows="10" class="form-control @error('deskripsi_acara') is-invalid @enderror" id="deskripsi_acara"
                            name='deskripsi_acara' autofocus='true' required value="{{ old('deskripsi_acara') }}"
                            id="floatingTextarea" placeholder="Masukan Deskripsi Event"></textarea>

                        @error('deskripsi_acara')
                            <div id="deskripsi_acara_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary w-100 btn-simpan mb-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            /* Script for Event price toogle */
            const radioPrice = document.querySelectorAll('input[type=radio][name=harga_tiket]');
            const inputPriceWrapper = document.getElementById('inputPriceWrapper');
            radioPrice.forEach(function(radio) {
                radio.addEventListener('click', function() {
                    inputPriceWrapper.classList.remove('d-none');

                    if (radio.value === 'gratis') {
                        inputPriceWrapper.classList.add('d-none');
                        inputPriceWrapper.querySelector('input').value = '';
                        inputPriceWrapper.querySelector('input').setAttribute('disabled', true);


                    } else {
                        inputPriceWrapper.classList.remove('d-none');
                        inputPriceWrapper.querySelector('input').removeAttribute('disabled');

                    }
                });
            });
        </script>

        <script>
            /* Script for Event Type toogle */

            const radioEventType = document.querySelectorAll('input[type=radio][name=tipe_event]');
            const locationInput = document.querySelectorAll('.event-location-input');

            radioEventType.forEach(function(radio) {
                radio.addEventListener('click', function() {

                    locationInput.forEach(function(input) {
                        console.log(input)
                        input.classList.remove('d-none');
                    });


                    if (radio.value === 'online') {

                        locationInput[1].classList.add('d-none');
                        locationInput[1].querySelector('input').value = '';
                        locationInput[1].querySelector('input').setAttribute('disabled', true);
                        locationInput[0].querySelector('select').removeAttribute('disabled')

                    } else {
                        locationInput[1].querySelector('input').removeAttribute('disabled');

                        locationInput[0].classList.add('d-none');
                        locationInput[0].querySelector('select').setAttribute('disabled', true)

                    }
                });
            });
        </script>

        <script>
            /* Script for preview image */
            function previewImage() {
                const image = document.querySelector('#image');
                const imagePreview = document.querySelector('.img-preview');

                const reader = new FileReader();

                reader.readAsDataURL(image.files[0]);

                reader.onload = function() {
                    imagePreview.src = reader.result;
                }
            }
        </script>

        <script>
            /* Add Slug */
            const name = document.querySelector('#nama_event');
            const slug = document.querySelector('#slug');

            name.addEventListener('change', function() {
                fetch(`{{ route('admin_events_checkslug') }}?name=${name.value}`)
                    .then(response => response.json())
                    .then(data => slug.value = data.slug)
            });
        </script>
    @endpush

</x-app-layout>
