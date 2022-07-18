<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Laporan;
use App\Models\Transaksi;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* For Development */
        $reportEvent = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('events.id_panitia', Auth::user()->id)
            ->select('events.*')
            ->groupBy('events.id')
            ->orderBy('events.waktu_acara', 'desc')
            ->get();

        /* For Production */
        /* $reportEvent = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('waktu_acara', '<=', now())
            ->where('events.id_panitia', Auth::user()->id)
            ->groupBy('events.id')
            ->orderBy('events.waktu_acara', 'desc')
            ->get(); */


        // return dd($reportEvent);

        return view('pages.admin.report.index', [
            'reportEvent' => $reportEvent,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = Event::where('uuid', $id)->first();

        $laporan = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('events.id', $event->id)
            ->select('laporans.*')
            ->get();

        $transaksis = Laporan::class;

        $gender =  DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.gender', DB::raw('COUNT(pesertas.gender) as count_gender'))
            ->groupBy('pesertas.gender')
            ->get();

        $absent = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('laporans.status_absen', DB::raw('COUNT(*) as count_absent'))
            ->groupBy('laporans.status_absen')
            ->get();
        $instansi = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.instansi_peserta', DB::raw('COUNT(*) as count_instansi'))
            ->groupBy('pesertas.instansi_peserta')
            ->orderBy('count_instansi', 'desc')
            ->get();

        $domisili = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.domisili', DB::raw('COUNT(*) as count_domisili'))
            ->groupBy('pesertas.domisili')
            ->orderBy('count_domisili', 'desc')
            ->get();
        $angkatan = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('pesertas.angkatan', DB::raw('COUNT(*) as count_angkatan'))
            ->groupBy('pesertas.angkatan')
            ->orderBy('count_angkatan', 'desc')
            ->get();
        $fakultas = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->join('fakultas', 'pesertas.id_fakultas', '=', 'fakultas.id')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('fakultas.nama', DB::raw('COUNT(*) as count_fakultas'))
            ->groupBy('pesertas.id_fakultas')
            ->orderBy('count_fakultas', 'desc')
            ->get();
        $jurusan = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->join('fakultas', 'pesertas.id_fakultas', '=', 'fakultas.id')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('pesertas.jurusan_peserta', DB::raw('COUNT(*) as count_jurusan'))
            ->groupBy('pesertas.jurusan_peserta')
            ->orderBy('count_jurusan', 'desc')
            ->get();


        return view('pages.admin.report.show', [
            'event' => $event,
            'laporan' => $laporan,
            'transaksi' => $transaksis,
            'genders' => $gender,
            'absents' => $absent,
            'instansis' => $instansi,
            'domisilis' => $domisili,
            'angkatan' => $angkatan,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function exportDomPDF($uuid)
    {

        $event = Event::where('uuid', $uuid)->first();
        $penyelenggara_event = Event::where('events.id', $event->id)
            ->join('users', 'users.id', '=', 'events.id_panitia')
            ->select('users.nama_user')
            ->first();

        $reportUser = DB::table('laporans')
            ->join('transaksis', 'laporans.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_peserta', '=', 'users.id')
            ->join('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->orderBy('users.nama_user', 'asc')
            ->select('users.*', 'pesertas.*', 'laporans.*')->get();

        $pdf = PDF::loadview('pages.admin.report.printDomPdf', [
            'pesertas' => $reportUser,
            'event' => $event,
            'penyelenggara_event' => $penyelenggara_event
        ]);
        // return dd($reportUser);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
        // $files = preg_replace('/[^a-zA-Z0-9]/', " ", $event->nama_event);
        // return $pdf->download('Laporan ' . $files . '.pdf');
    }

    public function exportPDF($uuid)
    {
        // return dd($uuid);

        // Browsershot::url('https://example.com')->save('example.pdf');
        $transaksi = Laporan::class;
        $event = Event::where('uuid', $uuid)->first();

        $laporan = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('events.id', $event->id)
            ->select('laporans.*')
            ->get();

        $reportUser = DB::table('laporans')
            ->join('transaksis', 'laporans.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_peserta', '=', 'users.id')
            ->join('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('users.nama_user', 'pesertas.*', 'laporans.*')->get();

        $gender =  DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.gender', DB::raw('COUNT(pesertas.gender) as count_gender'))
            ->groupBy('pesertas.gender')
            ->get();

        $absent = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('laporans.status_absen', DB::raw('COUNT(*) as count_absent'))
            ->groupBy('laporans.status_absen')
            ->get();
        $instansi = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.instansi_peserta', DB::raw('COUNT(*) as count_instansi'))
            ->groupBy('pesertas.instansi_peserta')
            ->orderBy('count_instansi', 'desc')
            ->get();

        $domisili = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('pesertas.domisili', DB::raw('COUNT(*) as count_domisili'))
            ->groupBy('pesertas.domisili')
            ->orderBy('count_domisili', 'desc')
            ->get();

        $angkatan = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('pesertas.angkatan', DB::raw('COUNT(*) as count_angkatan'))
            ->groupBy('pesertas.angkatan')
            ->orderBy('count_angkatan', 'desc')
            ->get();
        $fakultas = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->join('fakultas', 'pesertas.id_fakultas', '=', 'fakultas.id')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('fakultas.nama', DB::raw('COUNT(*) as count_fakultas'))
            ->groupBy('pesertas.id_fakultas')
            ->orderBy('count_fakultas', 'desc')
            ->get();
        $jurusan = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->join('fakultas', 'pesertas.id_fakultas', '=', 'fakultas.id')
            ->where('laporans.id_event', $event->id)
            ->where('pesertas.instansi_peserta', '=', 'usni')
            ->select('pesertas.jurusan_peserta', DB::raw('COUNT(*) as count_jurusan'))
            ->groupBy('pesertas.jurusan_peserta')
            ->orderBy('count_jurusan', 'desc')
            ->get();

        // $pdf = PDF::loadview('pages.admin.report.print', [
        //     'event' => $event,
        //     'laporan' => $laporan,
        //     'reportUser' => $reportUser,
        //     'genders' => $gender,
        //     'absents' => $absent,
        //     'instansis' => $instansi,
        //     'domisilis' => $domisili,
        //     'angkatan' => $angkatan,
        //     'fakultas' => $fakultas,
        //     'jurusan' => $jurusan
        // ]);
        // return $pdf->stream();
        // return $pdf->download('laporan-pegawai-pdf');
        return view('pages.admin.report.print', [
            'event' => $event,
            'laporan' => $laporan,
            'transaksi' => $transaksi,
            'reportUser' => $reportUser,
            'genders' => $gender,
            'absents' => $absent,
            'instansis' => $instansi,
            'domisilis' => $domisili,
            'angkatan' => $angkatan,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan
        ]);
    }
}
