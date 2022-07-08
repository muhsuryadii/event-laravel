<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $report = DB
        /*  $transaksi = DB::table('transaksis')
            ->join('event', 'transaksis.event_id', '=', 'events.id')
            ->select('transaksis.*')
            ->get();

        $laporan = DB::table('laporans')
            ->join('transaksis', 'transaksis.id', '=', 'laporans.id_transaksi')
            ->get(); */

        /* For Development */
        $reportEvent = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('waktu_acara', '>=', now())
            ->groupBy('events.id')
            ->get();

        /* For Production */
        /* $reportEvent = DB::table('laporans')
            ->join('events', 'laporans.id_event', '=', 'events.id')
            ->where('waktu_acara', '<=', now())
            ->groupBy('events.id')
            ->get(); */


        return dd($reportEvent);

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
