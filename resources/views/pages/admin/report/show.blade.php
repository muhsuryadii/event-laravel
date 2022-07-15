<x-app-layout>
  {{-- {{ dd($jurusan) }} --}}
  <div class="card-wrapper mb-7">
    <div class="pdf-export flex items-center justify-between">
      <h5 class="text-white">Nama Event : {{ $event->nama_event }}</h5>
      <a href="#" class="d-block btn text-primary w-fit bg-white">
        <i class="fa-regular fa-file-pdf mr-1 text-lg"></i>
        Export PDF
      </a>
    </div>
    <div class="card mb-3 p-4">
      <h3 class='mb-3 text-xl font-bold'>Laporan Absensi Peserta</h3>
      <div class="table-responsive data-table p-0">
        {{-- Livewire Data table --}}
        <div>
          <livewire:report.users name="report_user" :event="$event->id" :model="$transaksi" />
        </div>
      </div>
    </div>

    {{-- Chart Umum --}}
    <div class="card mb-5 p-4">
      <h3 class='mb-3 text-xl font-bold'>Detail Laporan Acara (Umum)</h3>
      <div class="chart-list-wrapper">

        <div class="chart-row flex">
          {{-- Gender chart --}}
          <div class="chart-wrapper w-full lg:w-1/2">
            <canvas id="genderChart" class='h-full w-full'></canvas>
          </div>

          {{-- Absent chart --}}
          <div class="chart-wrapper w-full lg:mt-5 lg:w-1/2">
            <canvas id="absentChart" class='h-full w-full'></canvas>
          </div>
        </div>
        {{-- Instansi chart --}}
        <div class="chart-wrapper w-full lg:mt-5">
          <canvas id="instansiChart" class='h-full w-full'></canvas>
        </div>
        {{-- Domisili chart --}}
        <div class="chart-wrapper w-full lg:mt-5">
          <canvas id="domisiliChart" class='h-full w-full'></canvas>
        </div>
      </div>
    </div>

    {{-- Chart Internal Usni --}}
    <div class="card mb-7 p-4">
      <h3 class='mb-3 text-xl font-bold'>Detail Laporan Acara (Internal USNI)</h3>
      <div class="chart-list-wrapper">

        {{-- Angkatan chart --}}
        <div class="chart-wrapper w-full lg:mt-5">
          <canvas id="angkatanChart" class='h-full w-full'></canvas>
        </div>
        {{-- Fakultas chart --}}
        <div class="chart-wrapper w-full lg:mt-5">
          <canvas id="fakultasChart" class='h-full w-full'></canvas>
        </div>

        {{-- Jurusan chart --}}
        <div class="chart-wrapper w-full lg:mt-5">
          <canvas id="jurusanChart" class='h-full w-full'></canvas>
        </div>

      </div>
    </div>
  </div>

  @push('js')
    {{-- import chart js script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
      Chart.register(ChartDataLabels)

      /* dataLabelsPercent */
      const dataLabelsPercent = {
        display: true,
        align: 'bottom',
        color: '#fff',
        borderRadius: 3,
        font: {
          size: 16,
        },
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });

          let percentage = (value * 100 / sum).toFixed(2);
          const result = `${percentage}% (${value})`;

          if (percentage >= 5) {
            return result;
          }
          return null;
        },
      }

      /* dataLabelsValue */
      const dataLabelsValue = {
        display: true,
        align: 'bottom',
        color: '#fff',
        borderRadius: 3,
        font: {
          size: 16,
        },
        formatter: (value, ctx) => {
          return value;
        },
      }

      const backgroundColorList = [
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(201, 203, 207, 0.7)'
      ];
      const borderColorList = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ];
      let reducer = (accumulator, curr) => accumulator + curr;
    </script>

    {{-- Gender Chart --}}
    <script>
      const ctxGender = document.getElementById('genderChart').getContext('2d');
      const genderData = {
        labels: ['Laki-Laki', 'Perempuan'],
        datasets: [{
          label: 'Jenis Kelamin',
          data: [
            {{ $genders[0]->gender == 'male' ? $genders[0]->count_gender : $genders[1]->count_gender }},
            {{ $genders[1]->gender == 'female' ? $genders[1]->count_gender : $genders[0]->count_gender }}
          ],
          backgroundColor: [
            backgroundColorList[4],
            backgroundColorList[0]
          ],
          borderColor: [
            borderColorList[4],
            borderColorList[0]
          ],
          borderWidth: 1
        }]
      }

      const genderChart = new Chart(ctxGender, {
        type: 'pie',
        data: genderData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jenis Kelamin'
            },
            datalabels: dataLabelsPercent
          }
        }
      });
    </script>

    {{-- Absent Chart --}}
    <script>
      const ctxAbsent = document.getElementById('absentChart').getContext('2d');
      const absentData = {
        labels: ['Hadir', 'Tidak Hadir'],
        datasets: [{
          label: 'Jumlah Kehadiran',
          data: [
            {{ $absents[0]->status_absen ? $absents[0]->count_absent : $absents[1]->count_absent }},
            {{ $absents[1]->status_absen ? $absents[1]->count_absent : $absents[0]->count_absent }}
          ],
          backgroundColor: [
            backgroundColorList[0],
            backgroundColorList[1]
          ],
          borderColor: [
            borderColorList[0],
            borderColorList[1]
          ],
          borderWidth: 1
        }]
      }

      const absentChart = new Chart(ctxAbsent, {
        type: 'pie',
        data: absentData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Kehadiran'
            },
            datalabels: dataLabelsPercent
          }
        }
      });
    </script>

    {{-- Instansi Chart --}}
    <script>
      const ctxInstansi = document.getElementById('instansiChart').getContext('2d');
      let labelsInstansi = [
        @foreach ($instansis as $instansi)
          ' {{ $instansi->instansi_peserta == 'usni' ? 'Universitas Satya Negara Indonesia' : $instansi->instansi_peserta }} ',
        @endforeach
      ]
      const labelsInstansiSlice = labelsInstansi.length >= 9 ? labelsInstansi.slice(0, 9) : labelsInstansi;
      labelsInstansiSlice.push('Lainnya');

      let datainstansi = [
        @foreach ($instansis as $instansi)
          {{ $instansi->count_instansi }},
        @endforeach
      ]
      const dataInstansiSlice = datainstansi.length >= 9 ? datainstansi.slice(0, 9) : datainstansi;

      const sisaSlice = datainstansi.length >= 9 ? datainstansi.slice(9, datainstansi.length) : datainstansi;
      const sisaSliceSum = sisaSlice.reduce(reducer);
      dataInstansiSlice.push(sisaSliceSum);

      const backgroundColorInstansi = []
      const borderColorInstansi = []
      let loopingIndicator = 0;

      for (let i = 0; i < labelsInstansiSlice.length; i++) {
        backgroundColorInstansi.push(backgroundColorList[loopingIndicator])
        borderColorInstansi.push(borderColorList[loopingIndicator])
        if (loopingIndicator == backgroundColorList.length - 1) {
          loopingIndicator = 0;
        } else {
          loopingIndicator++;
        }
      }

      const instansiData = {
        labels: labelsInstansiSlice,
        datasets: [{
          label: 'Orang',
          data: dataInstansiSlice,
          backgroundColor: backgroundColorInstansi,
          borderColor: borderColorInstansi,
          borderWidth: 1
        }]
      }
      const instansiChart = new Chart(ctxInstansi, {
        type: 'bar',
        data: instansiData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Instansi Peserta'
            },
            datalabels: dataLabelsValue
          }
        }
      });
    </script>

    {{-- Domisili Chart --}}
    <script>
      const ctxDomisili = document.getElementById('domisiliChart').getContext('2d');
      let labelsDomisili = [
        @foreach ($domisilis as $domisili)
          ' {{ $domisili->domisili }} ',
        @endforeach
      ]
      const labelsDomisiliSlice = labelsDomisili.length >= 9 ? labelsDomisili.slice(0, 9) : labelsDomisili;
      labelsDomisiliSlice.push('Lainnya');

      let dataDomisili = [
        @foreach ($domisilis as $domisili)
          {{ $domisili->count_domisili }},
        @endforeach
      ]
      const dataDomisiliSlice = dataDomisili.length >= 9 ? dataDomisili.slice(0, 9) : dataDomisili;

      const sisaSliceDomisili = dataDomisili.length >= 9 ? dataDomisili.slice(9, dataDomisili.length) : dataDomisili;
      const sisaSliceDomisiliSum = sisaSliceDomisili.reduce(reducer);
      dataDomisiliSlice.push(sisaSliceDomisiliSum);

      const backgroundColorDomisili = []
      const borderColorDomisili = []
      loopingIndicator = 0;

      for (let i = 0; i < labelsDomisiliSlice.length; i++) {
        backgroundColorDomisili.push(backgroundColorList[loopingIndicator])
        borderColorDomisili.push(borderColorList[loopingIndicator])
        if (loopingIndicator == backgroundColorList.length - 1) {
          loopingIndicator = 0;
        } else {
          loopingIndicator++;
        }
      }
      const domisiliData = {
        labels: labelsDomisiliSlice,
        datasets: [{
          label: 'Orang',
          data: dataDomisiliSlice,
          backgroundColor: backgroundColorDomisili,
          borderColor: borderColorDomisili,
          borderWidth: 1
        }]
      }
      const domisiliChart = new Chart(ctxDomisili, {
        type: 'bar',
        data: domisiliData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Domisili Peserta'
            },
            datalabels: dataLabelsValue
          }
        }
      });
    </script>

    {{-- Angkatan chart --}}
    <script>
      const ctxAngkatan = document.getElementById('angkatanChart').getContext('2d');
      let labelsAngkatan = [
        @foreach ($angkatan as $ang)
          ' {{ $ang->angkatan }} ',
        @endforeach
      ]
      let dataAngkatan = [
        @foreach ($angkatan as $ang)
          {{ $ang->count_angkatan }},
        @endforeach
      ]

      const backgroundColorAngkatan = []
      const borderColorAngkatan = []
      loopingIndicator = 0;

      for (let i = 0; i < labelsAngkatan.length; i++) {
        backgroundColorAngkatan.push(backgroundColorList[loopingIndicator])
        borderColorAngkatan.push(borderColorList[loopingIndicator])
        if (loopingIndicator == backgroundColorList.length - 1) {
          loopingIndicator = 0;
        } else {
          loopingIndicator++;
        }
      }
      const angkatanData = {
        labels: labelsAngkatan,
        datasets: [{
          label: 'Orang',
          data: dataAngkatan,
          backgroundColor: backgroundColorAngkatan,
          borderColor: borderColorAngkatan,
          borderWidth: 1
        }]
      }
      const angkatanChart = new Chart(ctxAngkatan, {
        type: 'bar',
        data: angkatanData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Angkatan Peserta'
            },
            datalabels: dataLabelsValue
          }
        }
      });
    </script>

    {{-- Fakultas chart --}}
    <script>
      const ctxFakultas = document.getElementById('fakultasChart').getContext('2d');
      let labelsFakultas = [
        @foreach ($fakultas as $fak)
          ' {{ $fak->nama }} ',
        @endforeach
      ]
      let dataFakultas = [
        @foreach ($fakultas as $fak)
          {{ $fak->count_fakultas }},
        @endforeach
      ]

      const backgroundColorFakultas = []
      const borderColorFakultas = []
      loopingIndicator = 0;

      for (let i = 0; i < labelsFakultas.length; i++) {
        backgroundColorFakultas.push(backgroundColorList[loopingIndicator])
        borderColorFakultas.push(borderColorList[loopingIndicator])
        if (loopingIndicator == backgroundColorList.length - 1) {
          loopingIndicator = 0;
        } else {
          loopingIndicator++;
        }
      }
      const fakultasData = {
        labels: labelsFakultas,
        datasets: [{
          label: 'Orang',
          data: dataFakultas,
          backgroundColor: backgroundColorAngkatan,
          borderColor: borderColorAngkatan,
          borderWidth: 1
        }]
      }
      const fakultasChart = new Chart(ctxFakultas, {
        type: 'bar',
        data: fakultasData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Fakultas Peserta'
            },
            datalabels: dataLabelsValue
          }
        }
      });
    </script>

    {{-- Jurusan chart --}}
    <script>
      const ctxJurusan = document.getElementById('jurusanChart').getContext('2d');
      let labelsJurusan = [
        @foreach ($jurusan as $jur)
          ' {{ $jur->jurusan_peserta }} ',
        @endforeach
      ]

      let dataJurusan = [
        @foreach ($jurusan as $jur)
          {{ $jur->count_jurusan }},
        @endforeach
      ]

      const backgroundColorJurusan = []
      const borderColorJurusan = []
      loopingIndicator = 0;

      for (let i = 0; i < labelsJurusan.length; i++) {
        backgroundColorJurusan.push(backgroundColorList[loopingIndicator])
        borderColorJurusan.push(borderColorList[loopingIndicator])
        if (loopingIndicator == backgroundColorList.length - 1) {
          loopingIndicator = 0;
        } else {
          loopingIndicator++;
        }
      }
      const jurusanData = {
        labels: labelsJurusan,
        datasets: [{
          label: 'Orang',
          data: dataJurusan,
          backgroundColor: backgroundColorAngkatan,
          borderColor: borderColorAngkatan,
          borderWidth: 1
        }]
      }
      const jurusanChart = new Chart(ctxJurusan, {
        type: 'bar',
        data: jurusanData,
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Jumlah Jurusan Peserta'
            },
            datalabels: dataLabelsValue
          }
        }
      });
    </script>
  @endpush
</x-app-layout>
