<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
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

        //store data to new variable
        $lokasi_acara = $request->tipe_acara == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;
        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : ($request->harga_tiket_bayar == null ? 0 : $request->harga_tiket_bayar);
        $image = null;

        if ($request->file('image')) {
            $image =  $request->file('image') ? $request->file('image')->store('images/events') : null;
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }


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
            'famplet_acara_path' => 'nullable'
        ])->validate();

        Event::create($validator);
        return redirect(route('admin_events_index'))->with('EventSuccess', 'Event berhasil ditambahkan');
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
        // return dd($request->all());
        $lokasi_acara = $request->tipe_acara == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;
        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : ($request->harga_tiket_bayar == null ? 0 : $request->harga_tiket_bayar);



        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete(['file', 'otherFile']);
                ($request->oldImage);
            }
            $image = $request->file('image')->store('images/events');

            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } else {
            $image = $request->oldImage;
        }

        $eventData = [
            'id_panitia' => $request->id_penyelenggara_event,
            'nama_event' => $request->nama_event,
            'slug' => $request->slug,
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

        $event = Event::where('slug', $id)->firstOrFail();
        if ($request->slug != $event->slug) {
            array_push($eventData, [
                'slug' => $request->slug,
            ]);

            $validator =  Validator::make(
                $eventData,
                [
                    'slug' => 'required|unique:events|max:255',
                    'id_panitia' => 'required|exists:users,id',
                    'nama_event' => 'required|max:255',
                    'waktu_acara' => 'required|after_or_equal:today',
                    'harga_tiket' => 'required|numeric',
                    'kuota_tiket' => 'required|numeric',
                    'lokasi_acara' => 'required|max:150',
                    'tipe_acara' => 'required',
                    'deskripsi_acara' => 'required',
                    'famplet_acara_path' => 'nullable'
                ]
            );
        } else {
            $validator =  Validator::make($eventData, [
                'id_panitia' => 'required|exists:users,id',
                'nama_event' => 'required|max:255',
                'waktu_acara' => 'required|after_or_equal:today',
                'harga_tiket' => 'required|numeric',
                'kuota_tiket' => 'required|numeric',
                'lokasi_acara' => 'required|max:150',
                'tipe_acara' => 'required',
                'deskripsi_acara' => 'required',
                'famplet_acara_path' => 'nullable'
            ]);
        }


        $updateData = $validator->validate();

        // return dd($updateData);

        Event::where('id', $event->id)->update($updateData);

        return redirect(route('admin_events_index'))->with('updateSuccess', 'Update Berhasil');
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

        $event = Event::where('slug', $id)->firstOrFail();
        Event::destroy($event->id);

        /* delete image form local when it is deleted */
        if ($event->famplet_acara_path) {
            Storage::delete($event->famplet_acara_path);
        }


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
