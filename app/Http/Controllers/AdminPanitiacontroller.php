<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminPanitiacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $panitia = DB::table('users')
            ->where('role', 'PANITIA')
            ->orderBy('nama_user', 'asc')
            ->get();

        return view('pages.admin.panitia.index', [
            'panitias' => $panitia,
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
        return view('pages.admin.panitia.create');
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

        $dataPanitia = [
            'nama_user' => $request->nama_panitia,
            'email' => $request->email_panitia,
            'password' => $request->password_panitia,
            'password_confirmation' => $request->password_confirmation,
            'role' => 'PANITIA',
        ];
        $validator = Validator::make($dataPanitia, [
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin_panitia_create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $insertData = $validator->validate();
            $insertData['password'] = bcrypt($insertData['password']);
            $insertData['uuid'] = Str::uuid()->getHex();

            DB::table('users')->insert($insertData);
            return redirect()->route('admin_panitia_index')->with('success', 'Data Panitia berhasil ditambahkan');
        }
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
    public function edit($uuid)
    {
        //
        $panitia = DB::table('users')
            ->where('uuid', $uuid)
            ->first();
        return view('pages.admin.panitia.edit', [
            'panitia' => $panitia,
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

        $user = DB::table('users')
            ->where('uuid', $id)
            ->first();

        $password = $request->password_panitia;
        $password_confirmation = $request->password_confirmation;

        // return dd($request, $user);
        // 
        if ($password || $password_confirmation) {
            $dataPanitia = [
                'nama_user' => $request->nama_panitia,
                'email' => $request->email_panitia,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
            ];

            if ($user->email  ==  $request->email_panitia) {
                $validator = Validator::make($dataPanitia, [
                    'nama_user' => 'required|string|max:255',
                    'email' => 'required|string|email:rfc,dns|max:255',
                    'password' => 'required|string|min:6|confirmed'
                ]);
            } else {
                $validator = Validator::make($dataPanitia, [
                    'nama_user' => 'required|string|max:255',
                    'email' => 'required|string|email:rfc,dns|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed'
                ]);
            }
        } else {
            $dataPanitia = [
                'nama_user' => $request->nama_panitia,
                'email' => $request->email_panitia,
                'role' => 'PANITIA',
            ];

            if ($user->email  ==  $request->email_panitia) {
                $validator = Validator::make($dataPanitia, [
                    'nama_user' => 'required|string|max:255',
                    'email' => 'required|string|email:rfc,dns|max:255',
                    'role' => 'required|string|max:255',
                ]);
            } else {
                $validator = Validator::make($dataPanitia, [
                    'nama_user' => 'required|string|max:255',
                    'email' => 'required|string|email:rfc,dns|max:255|unique:users',
                    'role' => 'required|string|max:255',
                ]);
            }
        }


        if ($validator->fails()) {
            return redirect()
                ->route('admin_panitia_edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $insertData = $validator->validate();

            if ($password || $password_confirmation) {
                $insertData['password'] = bcrypt($insertData['password']);
            }

            DB::table('users')->where('uuid', $id)->update($insertData);
            return redirect()->route('admin_panitia_index')->with('success', 'Data Panitia berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //

        $user = DB::table('users')
            ->where('uuid', $uuid)
            ->first();



        $transaksi = DB::table('transaksis')
            ->join('events', 'transaksis.id_event', '=', 'events.id')
            ->where('id_panitia', $user->id)
            ->first();

        // return dd($user->id);



        if ($transaksi) {
            return redirect()->route('admin_panitia_index')->with('error', 'Data Panitia tidak dapat dihapus karena masih memiliki transaksi');
        } else {
            DB::table('users')->where('id', $user->id)->delete();
            return redirect()->route('admin_panitia_index')->with('success', 'Data Panitia berhasil dihapus');
        }
    }
}
