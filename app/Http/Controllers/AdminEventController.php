<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return view('pages.admin.event.index', [
            'events' => Event::all()->where('id_panitia', Auth::user()->id)->sortByDesc('waktu_acara'),
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
        return view('pages.admin.event.create', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->all());

        //store data to new variable

        $lokasi_acara = $request->tipe_event == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;
        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : $request->harga_tiket_bayar;

        $eventData = [
            'id_panitia' => $request->id_penyelenggara_event,
            'nama_event' => $request->nama_event,
            'slug' => $request->slug,
            'waktu_acara' => $request->waktu_acara,
            'harga_tiket' => $harga_tiket,
            'kuota_tiket' => $request->kuota_tiket,
            'lokasi_acara' => $lokasi_acara,
            'tipe_acara' => $request->tipe_event,
            'deskripsi_acara' => $request->deskripsi_acara,
            'image' => $request->image,
        ];

        // return dd($eventData);

        // Validate Input
        Validator::make($eventData, [
            'id_penyelenggara_event' => 'required|exists:users.id',
            'nama_event' => 'required|max:255',
            'slug' => 'required|unique:events|max:255',
            'waktu_acara' => 'required|date_format:Y-m-d H:i|after_or_equal:today',
            'image' => 'image|file|max:1024',
            'harga_tiket' => 'required|numeric',
            'kuota_tiket' => 'required|numeric',
            'lokasi_acara' => 'required|max:150',
            'tipe_acara' => 'required|in:online,offline',
            'deskripsi_acara' => 'required',
            'image' => 'image|file|max:1024'
        ]);

        if ($request->file('image')) {
            $eventData['famplet_acara_path'] = $request->file('image')->store('/images/events');
        }

        Event::create($eventData);
        return redirect(route('admin_events_index'))->with('EventSuccess', 'Event berhasil ditambahkan');


        // famplet_acara_path	


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
        $event = Event::where('slug', $id)->firstOrFail();

        return view('pages.admin.event.edit', [
            'event' => $event,
            'user' => Auth::user(),
        ]);
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


    /* Check Sluggable For Create Event */
    public function checkSlug(Request $request)
    {
        // echo $request->name;
        $slug = SlugService::createSlug(Event::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
