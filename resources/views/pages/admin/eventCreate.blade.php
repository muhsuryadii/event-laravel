<x-app-layout>
    {{-- {{ dd($user) }} --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <form action='{{ route('admin_events_store') }}' method="POST" enctype="multipart/form-data"
                    class="p-[1.5rem]">
                    @csrf

                    {{-- Penyelenggara Event --}}
                    <div class="mb-4">
                        <label for="id_penyelenggara_event"
                            class="form-label text-sm @error('penyelenggara_event') is-invalid @enderror"
                            value="{{ old('penyelenggara_event') }}">Penyelenggara <span
                                class="text-xxs text-danger">(*)</span>
                        </label>

                        <input disabled type="text" class="form-control" value="{{ $user->nama_user }}"
                            id="penyelenggara_event" name='penyelenggara_event'>

                        <input hidden type="text" class="form-control d-none" value={{ $user->id }}
                            id="id_penyelenggara_event" name='id_penyelenggara_event'>

                        @error('penyelenggara_event')
                            <div id="penyelenggara_event_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" name="slug" id="slug">
                    </div>

                    {{-- Nama Event --}}
                    <div class="mb-4">
                        <label for="nama_event"
                            class="form-label text-sm @error('nama_event') is-invalid @enderror">Nama
                            Event <span class="text-xxs text-danger">(*)</span> </label>
                        <input type="text" class="form-control" id="nama_event" name='nama_event' autofocus='true'
                            required value="{{ old('nama_event') }}" placeholder="Masukan Nama Event">

                        @error('nama_event')
                            <div id="nama_event_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" name="slug" id="slug">
                    </div>

                    {{-- Watku Event --}}
                    <div class="mb-4">
                        <label for="birthdaytime"
                            class="form-label text-sm @error('birthdaytime') is-invalid @enderror">Tanggal / Waktu Event
                            <span class="text-xxs text-danger">(*)</span> </label>

                        <input type="datetime-local" class="form-control" id="birthdaytime" name="birthdaytime"
                            required value="{{ old('birthdaytime') }}">

                        @error('birthdaytime')
                            <div id="datetime_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Harga Tiket --}}
                    <div class="mb-4">
                        <label for="name" class="form-label text-sm @error('nama_event') is-invalid @enderror"
                            value="{{ old('harga_tiket') }}">Harga Tiket</label>

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
                            <input class="form-control" type="number" placeholder="Masukan harga tiket"
                                pattern="[0-9]" disabled>
                        </div>
                        {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket' autofocus='true'> --}}

                        @error('harga_tiket')
                            <div id="ticket_price_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Kuota Tiket --}}
                    <div class="mb-4">
                        <label for="kuota_tiket"
                            class="form-label text-sm @error('kuota_tiket') is-invalid @enderror">Kuota
                            Tiket <span class="text-xxs text-danger">(*)</span> </label>
                        <input type="number" class="form-control" id="kuota_tiket" name='kuota_tiket' autofocus='true'
                            required value="{{ old('kuota_tiket') }}" placeholder="Masukan Kuota Tiket">

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
                            <select class="form-select" aria-label="Default select example">
                                <option value="Zoom" selected>Zoom</option>
                                <option value="Google Meet">Google Meet</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <div id='eventOffline' class="input-group mb-4 event-location-input d-none">
                            <div class="mb-4  w-100">
                                <input type="text" class="form-control" id="lokasi_event" name='lokasi_event'
                                    autofocus='true' value="{{ old('lokasi_event') }}"
                                    placeholder="Masukan Lokasi Event" disabled>

                                @error('lokasi_event')
                                    <div id="lokasi_event_feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <input type="text" class="form-control" id="harga_tiket" name='harga_tiket' autofocus='true'> --}}


                    </div>

                    {{-- Deskripsi Event --}}
                    <div class="mb-4">
                        <label for="desripsi_event"
                            class="form-label text-sm @error('desripsi_event') is-invalid @enderror">Deskripsi Event
                            <span class="text-xxs text-danger">(*)</span>
                        </label>
                        <textarea rows="10" class="form-control" id="desripsi_event" name='desripsi_event' autofocus='true' required
                            value="{{ old('desripsi_event') }}" id="floatingTextarea"
                            placeholder="Masukan Deskripsi Event"></textarea>

                        @error('desripsi_event')
                            <div id="desripsi_event_feedback" class="invalid-feedback">
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
    @endpush

</x-app-layout>
