<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class MyEventController extends Controller
{
    //
    public function index()
    {
        $events = DB::table('events')
            ->join('transaksis', 'events.id', '=', 'transaksis.id_event')
            ->where('transaksis.id_peserta', Auth::user()->id)
            ->where('transaksis.status_transaksi', 'verified')
            ->orderBy('events.waktu_acara', 'desc')
            ->select('events.*',)
            ->get();

        return view('pages.customer.my-events.index', [
            'events' => $events,
        ]);
    }

    public function show(Request $request, string $uuid)
    {
        $event = DB::table('events')
            ->join('transaksis', 'events.id', '=', 'transaksis.id_event')
            ->where('events.uuid', $uuid)
            ->where('transaksis.id_peserta', Auth::user()->id)
            ->where('transaksis.status_transaksi', 'verified')
            ->select('events.*', 'transaksis.*', 'events.uuid as uuid_event', 'events.id as id_event', 'transaksis.id as id_transaksi')
            ->first();

        return view('pages.customer.my-events.show', [
            'event' => $event,
        ]);
    }

    public function absent(Request $request, string $uuid)
    {

        // return dd($request);
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $reportData = [
            'uuid' => Str::uuid()->getHex(),
            'id_event' => $request->id_event,
            'id_peserta' => $request->id_peserta,
            'id_transaksi' => $request->id_transaksi,
            'status_absen' => true,
        ];

        $validator =  Validator::make($reportData, [
            'uuid' => 'required|unique:laporans,uuid',
            'id_event' => 'required|exists:events,id',
            'id_peserta' => 'required|exists:users,id',
            'id_transaksi' => 'required|exists:transaksis,id',
            'status_absen' => 'required',
        ])->validate();

        Laporan::create($validator);

        return redirect()->route('my-events_show', $uuid)->with('success', 'Absen Berhasil');
    }
}
