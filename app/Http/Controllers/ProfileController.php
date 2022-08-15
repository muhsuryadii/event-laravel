<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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

        // return dd($request);

        $instansi = $request->instansi == 'usni' ? $request->instansi : $request->instansi_lain;

        $pesertaData = [
            'id_users' => $request->id_user,
            'nama_user' => $request->nama_user,
            'instansi_peserta' =>  $instansi,
            // 'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'domisili' => $request->domisili,
            'no_telepon' => $request->no_telepon,
            'id_fakultas' => $request->fakultas,
            'jurusan_peserta' => $request->jurusan,
            'angkatan' => $request->angkatan,
        ];
        
        if ($request->instansi == 'usni') {

            $validator =  Validator::make($pesertaData, [
                'id_users' => 'required|exists:users,id',
                'instansi_peserta' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                // 'tanggal_lahir' => 'string|max:255',
                'gender' => 'in:male,female|nullable',
                'domisili' => 'string|max:255|nullable',
                'id_fakultas' => 'exists:fakultas,id|nullable',
                'jurusan_peserta' => 'string|nullable',
                'angkatan' => 'string|min:4|nullable',
            ])->validate();
        } else {
            $validator =  Validator::make($pesertaData, [
                'id_users' => 'required|exists:users,id',
                'instansi_peserta' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                // 'tanggal_lahir' => 'string|max:255|nullable',
                'gender' => 'in:male,female|nullable',
                'domisili' => 'string|max:255|nullable',
            ])->validate();
        }


        $namaValidator = Validator::make($pesertaData, [
            'nama_user' => 'required|string|max:255',
        ])->validate();


        $peserta = Peserta::where('id_users', $request->id_user)->first();

        if ($peserta) {
            Peserta::where('id_users', $request->id_user)->update($validator);
        } else {
            Peserta::create($validator);
        }

        User::where('id', $request->id_user)->update($namaValidator);

        return redirect()->route('profile_show', Auth::user()->uuid)->with('success', 'Update Biodata Berhasil');
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
