<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (Auth::user()->uuid != $id) {
            return redirect()->route('home');
        }
        $user  = DB::table('users')
            ->where('uuid', $id)
            ->first();

        $peserta = DB::table('pesertas')->where('id_users', $user->id)->first();



        return view('pages.customer.profile.show', [
            'user' => $user,
            'peserta' => $peserta,
        ]);
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
        $user  = DB::table('users')
            ->where('uuid', $id)
            ->first();
        $peserta = DB::table('pesertas')->where('id_users', $user->id)->first();
        $response = Http::get('https://ibnux.github.io/data-indonesia/provinsi.json');
        $prov = $response->json();
        $fakultas = DB::table('fakultas')->get();

        // return dd($prov);
        return view('pages.customer.profile.edit', [
            'user' => $user,
            'peserta' => $peserta,
            'provinsi' => $prov,
            'fakultas' => $fakultas,

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
}
