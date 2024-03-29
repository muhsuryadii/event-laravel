<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::join('users', 'events.id_panitia', '=', 'users.id')
            ->select('events.*', 'users.nama_user as nama_panitia')
            ->orderBy('waktu_acara', 'desc')->paginate(10);

        return view('pages.customer.event.index', [
            'events' => $events,
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
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //

        if (auth()->user()) {
            $transaction = Transaksi::where('id_event', $event->id)
                ->where('id_peserta', auth()->user()->id)
                ->first();
        } else {
            $transaction = null;
        }

        $panitia = DB::table('users')
            ->join('events', 'id_panitia', '=', 'users.id')
            ->where('events.id_panitia', $event->id_panitia)
            ->select('users.*')
            ->groupBy('users.id')
            ->first();

        $humaslist = DB::table('humas')
            ->join('events', 'id_event', '=', 'events.id')
            ->where('events.id', $event->id)
            ->select('humas.*')->get();


        return view('pages.customer.event.show', [
            'event' => $event,
            'transaction' => $transaction,
            'panitia' =>  $panitia,
            'humasList' => $humaslist,


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }


    public function search(Request $request)
    {
        //
        // return dd($request);
        $req = $request->get('search');


        $events = Event::join('users', 'events.id_panitia', '=', 'users.id')
            ->select('events.*', 'users.nama_user as nama_panitia')
            ->where('nama_event', 'like', '%' . $req . '%')
            ->orderBy('waktu_acara', 'asc')->paginate(10);

        return view('pages.customer.event.search', [
            'events' => $events,
            'request' => $req
        ]);
    }

    public function event_by($uuid)
    {
        $user = DB::table('users')
            ->where('uuid', $uuid)
            ->first();

        $events = Event::join('users', 'events.id_panitia', '=', 'users.id')
            ->select('events.*', 'users.nama_user as nama_panitia')
            ->where('id_panitia', '=', $user->id)
            ->orderBy('waktu_acara', 'desc')->paginate(10);

        return view('pages.customer.event.eventBy', [
            'user' => $user,
            'events' => $events,
        ]);
    }
}
