<x-app-layout>
  {{-- {{ dd($peserta) }} --}}
  <div class="card-wrapper">
    <div class="pdf-export flex items-center justify-between">
      <h5 class="text-white">Nama Event : {{ $event->nama_event }}</h5>
      <a href="#" class="d-block btn text-primary w-fit bg-white">
        <i class="fa-regular fa-file-pdf mr-1 text-lg"></i>
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
