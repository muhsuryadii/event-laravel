<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return redirect()->route('home');
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
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $no_transaksi = 'INV-' . date('YmdHi') . $request->event_id . $request->user_id;

        $chekoutData = [
            'id_event' => $request->event_id,
            'id_peserta' => $request->user_id,
            'total_harga' => $request->harga_tiket,
            'no_transaksi' => $no_transaksi,
            'status_transaksi' => $request->harga_tiket == 0 ? 'pending' : 'not_paid',
        ];

        $validator =  Validator::make($chekoutData, [
            'id_event' => 'required|exists:events,id',
            'id_peserta' => 'required|exists:users,id',
            'total_harga' => 'required|numeric',
            'no_transaksi' => 'required|unique:transaksis,no_transaksi'
        ])->validate();

        Transaksi::create($validator);


        return redirect()->route('checkout_show', $no_transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        // $user = $transaksi->load(['user', 'event']);

        return view('pages.customer.chekout.show', [
            'transaksi' => $transaksi,
            'event' =>  Event::find($transaksi->id_event),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
        // return dd($request, $transaksi);

        $image = null;

        if ($request->file('bukti_transaksi')) {
            $image =  $request->file('bukti_transaksi') ? $request->file('bukti_transaksi')->store('images/bukti_transaksi') : null;
            $this->validate($request, [
                'bukti_transaksi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $transaksi->update([
            'bukti_transaksi' => $image,
            'status_transaksi' => 'pending',
            'waktu_pembayaran' => now(),
        ]);


        // return redirect()->route('checkout_show', $no_transaksi);
        return redirect()->route('checkout_show', $request->no_transaksi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaction)
    {
        //
    }
}
