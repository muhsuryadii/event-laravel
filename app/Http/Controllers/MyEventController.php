<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // return dd($uuid);
        $event = DB::table('events')
            ->join('transaksis', 'events.id', '=', 'transaksis.id_event')
            ->where('events.uuid', $uuid)
            ->where('transaksis.id_peserta', Auth::user()->id)
            ->where('transaksis.status_transaksi', 'verified')
            ->first();

        return view('pages.customer.my-events.show', [
            'event' => $event,
        ]);
    }
}
