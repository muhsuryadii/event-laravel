<x-app-layout>
  {{-- {{ dd($absents) }} --}}
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
    <div class="card mb-7 p-4">
      <h3 class='mb-3 text-xl font-bold'>Detail Laporan Acara (Umum)</h3>
      <div class="chart-list-wrapper flex">

        {{-- Gender chart --}}
        <div class="chart-wrapper w-full lg:w-1/2">
          <canvas id="genderChart" class='h-full w-full'></canvas>
        </div>

        {{-- Absent chart --}}
        <div class="chart-wrapper w-full lg:w-1/2">
          <canvas id="absentChart" class='h-full w-full'></canvas>
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
      const dataLabelsPie = {
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
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          const result = `${percentage} (${value})`;
          return result;
        },
      }
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
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 99, 132, 0.6)',
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
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
            datalabels: dataLabelsPie
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
            'rgba(160,217,149, 0.8)',
            'rgba(255, 99, 132, 0.6)',
          ],
          borderColor: [
            'rgba(160,217,149, 1)',
            'rgba(255, 99, 132, 1)',
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
            datalabels: dataLabelsPie
          }
        }
      });
    </script>
  @endpush
</x-app-layout>
