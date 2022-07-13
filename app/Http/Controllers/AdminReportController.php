<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $peserta  = DB::table('users')
            ->join('laporans', 'users.id', '=', 'laporans.id_peserta')
            ->leftjoin('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('laporans.id_event', $event->id)
            ->select('users.*', 'pesertas.*')
            ->get();

        return view('pages.admin.report.show', [
            'event' => $event,
            'laporan' => $laporan,
            'peserta' => $peserta,
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
}
