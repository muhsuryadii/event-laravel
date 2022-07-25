<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MyEventController extends Controller
{
    //
    public function index()
    {
        $events = DB::table('events')
            ->join('transaksis', 'events.id', '=', 'transaksis.id_event')
            ->join('laporans', 'transaksis.id', '=', 'laporans.id_transaksi')
            ->where('transaksis.id_peserta', Auth::user()->id)
            ->where('transaksis.status_transaksi', 'verified')
            ->orderBy('events.waktu_acara', 'desc')
            ->select('events.*', 'events.uuid as event_id', 'laporans.*')
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

        $laporan = DB::table('events')
            ->join('laporans', 'events.id', '=', 'laporans.id_event')
            ->where('events.uuid', $uuid)
            ->where('laporans.id_peserta', Auth::user()->id)
            ->first();

        return view('pages.customer.my-events.show', [
            'event' => $event,
            'laporan' => $laporan,
        ]);
    }

    public function absent(Request $request, string $uuid)
    {

        // return dd($request);
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        // laporan query check

        $laporan = DB::table('laporans')
            ->where('id', $request->id_laporan)
            ->first();

        if ($laporan->status_absen === true) {
            return redirect()->route('my-events_show', $uuid);
        }

        $reportData = [
            'status_absen' => true,
        ];


        $validator =  Validator::make($reportData, [
            'status_absen' => 'required',
        ])->validate();

        // Laporan::create($validator);
        Laporan::where('id', $request->id_laporan)
            ->update($validator);

        return redirect()->route('my-events_show', $uuid)->with('success', 'Absen Berhasil');
    }

    public function grenateCertificate(Request $request, string $uuid)
    {
        $event = Event::where('uuid', $uuid)->first();
        $layouts = DB::table('certificate_layouts')
            ->where('id_event', $event->id)
            ->first();

        $img = Image::make(public_path('storage/' . $layouts->certificate_path))->encode('jpg');

        $fontSize = $layouts->fontSize;
        $fontColor = $layouts->color;

        $img->text(Auth::user()->nama_user, $layouts->x, $layouts->y, function ($font) use ($fontSize, $fontColor) {
            $font->file('fonts/arial.ttf');
            $font->size($fontSize);
            $font->color($fontColor);
            $font->align('center');
        });

        $hash = md5($img->__toString());
        $path = "storage/images/certificates/{$hash}.jpg";
        // Storage::put($path, $img);
        $img->save(public_path($path));
    }
}
