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

        $lokasi_acara = $request->tipe_acara == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;
        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : ($request->harga_tiket_bayar == null ? 0 : $request->harga_tiket_bayar);

        $image =  $request->file('image') ? $request->file('image')->store('/images/events') : null;

        $eventData = [
            'id_panitia' => $request->id_penyelenggara_event,
            'nama_event' => $request->nama_event,
            'slug' => $request->slug != null ? $request->slug : SlugService::createSlug(Event::class, 'slug', $request->nama_event),
            'waktu_acara' => $request->waktu_acara,
            'harga_tiket' => $harga_tiket,
            'kuota_tiket' => (int) $request->kuota_tiket,
            'lokasi_acara' => $lokasi_acara,
            'tipe_acara' => $request->tipe_acara,
            'deskripsi_acara' => $request->deskripsi_acara,
            'famplet_acara_path' => $image,
        ];

        // return dd($eventData);

        // Validate Input
        $validator =  Validator::make($eventData, [
            'id_panitia' => 'required|exists:users,id',
            'nama_event' => 'required|max:255',
            'slug' => 'required|unique:events|max:255',
            'waktu_acara' => 'required|after_or_equal:today',
            'harga_tiket' => 'required|numeric',
            'kuota_tiket' => 'required|numeric',
            'lokasi_acara' => 'required|max:150',
            'tipe_acara' => 'required',
            'deskripsi_acara' => 'required',
            'famplet_acara_path' => 'nullable|image|file|max:1024|'
        ])->validate();

        // $validator->after(function ($validator){

        // })


        // return  dd($validator);



        Event::create($validator);
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
        // Event:: destroy()

        $event = Event::where('slug', $id)->firstOrFail();
        Event::destroy($event->id);
        return redirect(route('admin_events_index'))->with('deleteSuccess', 'Event berhasil dihapus');
    }


    /* Check Sluggable For Create Event */
    public function checkSlug(Request $request)
    {
        // echo $request->name;
        $slug = SlugService::createSlug(Event::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
