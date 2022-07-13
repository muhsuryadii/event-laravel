<x-app-layout>
    {{-- {{ dd($peserta) }} --}}
    <div class="card-wrapper">
        <div class="pdf-export flex justify-between items-center">
            <h5 class="text-white">Nama Event : {{ $event->nama_event }}</h5>
            <a href="#" class="d-block w-fit btn bg-white text-primary ">
                <i class="fa-regular fa-file-pdf text-lg mr-1"></i>
                Export PDF
            </a>
        </div>
        <div class="card p-4">

            <h1>Test</h1>
        </div>
    </div>

    @push('js')
    @endpush
</x-app-layout>
