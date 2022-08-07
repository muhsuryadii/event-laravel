<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Laporan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // nambahin 5 jam setelah 
        $gapHours = Carbon::parse(now())->subHour(5)->format('Y-m-d H:i:s');

        $transaksi =
            DB::table('transaksis')->join('events', 'transaksis.id_event', '=', 'events.id')
            ->where('id_panitia', Auth::user()->id)
            // ->where('events.waktu_acara', '>=', now())
            ->where('events.waktu_acara', '>=', $gapHours)
            ->groupBy('transaksis.id_event')
            ->orderBy('events.waktu_acara', 'DESC')
            ->get();

        return view('pages.admin.transaksi.index', [
            'events' => $transaksi
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        //


        $event = DB::table('events')->where('uuid', $uuid)->first();

        if ($event->id_panitia != Auth::user()->id) {
            return redirect(route('admin_transaksi_index'));
        }

        if ($event->waktu_acara < now()) {
            return redirect(route('admin_transaksi_index'))->with('error', 'Event Telah Selesai');
        }

        $eventTransaksi = DB::table('transaksis')
            ->join('events', 'transaksis.id_event', '=', 'events.id')
            ->join('users', 'transaksis.id_peserta', '=', 'users.id')
            ->join('pesertas', 'users.id', '=', 'pesertas.id_users')
            ->where('transaksis.id_event', '=', $event->id)
            ->where('transaksis.status_transaksi', '!=', 'not_paid')
            ->where('transaksis.status_transaksi', '!=', 'rejected')
            ->select('transaksis.*', 'users.uuid as usersId', 'users.nama_user', 'no_telepon')
            ->orderBy('transaksis.tanggal_transaksi', 'asc')
            ->get();



        return view('pages.admin.transaksi.show', [
            'transaksi' => $eventTransaksi,
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $event = Transaksi::join('events', 'transaksis.id_event', '=', 'events.id')
            ->where('events.id', $transaksi->id_event)
            ->select('events.*')
            ->first();

        $user = Transaksi::join('users', 'transaksis.id_peserta', '=', 'users.id')
            ->where('transaksis.id_event', $transaksi->id_event)
            ->select('users.*')->first();

        $transaksi->update([
            'status_transaksi' => $request->status_transaksi
        ]);

        if ($request->status_transaksi == 'rejected') {
            $kuota = $event->kuota_tiket + 1;
            Event::where('id', $transaksi->id_event)->update([
                'kuota_tiket' => $kuota
            ]);
            MailController::transactionFailed($user->email, $event->id);
        } else {

            $url = MailController::make_google_calendar_link($event->nama_event, Carbon::parse($event->waktu_acara)->timestamp, Carbon::parse($event->waktu_acara)->addHours(2)->timestamp, $event->lokasi_acara, $event->deskripsi_acara);

            MailController::transactionSuccess($user->email, $event->wa_grup, $event,  $url);
        }


        return redirect()->route('admin_transaksi_show', $event->uuid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
