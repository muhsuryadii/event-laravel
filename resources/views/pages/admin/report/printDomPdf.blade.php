<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ 'Laporan ' . preg_replace('/[^a-zA-Z0-9]/', ' ', $event->nama_event) . ' pdf' }}</title>

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="{{ public_path('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ public_path('css/print.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


  <!-- Scripts -->
  <script src="{{ public_path('js/app.js') }}" defer></script>

  <!-- CSS Files -->
  <link id="pagestyle" type="text/css" href={{ public_path('argon/css/argon-dashboard.css?v=2.0.2') }}
    rel="stylesheet" />
</head>

<body class=''>

  <div class="pdf-wrapper">

  </div>
  <h3 class="title-report">Laporan Acara {{ $event->nama_event }}</h3>
  <div class="event-report-info mt-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>Penyelenggara Event</td>
            <td>:</td>
            <td> {{ $penyelenggara_event->nama_user }}</td>
          </tr>
          <tr>
            <td>Tanggal Event</td>
            <td>:</td>
            <td> {{ Carbon\Carbon::parse($event->waktu_acara)->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>Tanggal Export Laporan</td>
            <td>:</td>
            <td> {{ Carbon\Carbon::parse(now())->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>Jumlah Peserta</td>
            <td>:</td>
            <td>{{ count($pesertas) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="peserta-list-wrapper">
    <div class="table-responsive">
      <table class="table-striped table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Instansi</th>
            <th scope="col">No HP</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pesertas as $peserta)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $peserta->nama_user }}</td>

              <td>
                @if (isset($peserta))
                  @if ($peserta->instansi_peserta == 'usni')
                    Universitas Satya Negara Indonesia
                  @else
                    {{ $peserta->instansi_peserta }}
                  @endif
                @endif
              </td>
              <td>{{ $peserta && isset($peserta->no_telepon) ? $peserta->no_telepon : '-' }}</td>
              <td>{{ $peserta && isset($peserta->email) ? $peserta->email : '-' }}</td>

            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>
