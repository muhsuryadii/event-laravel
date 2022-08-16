<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\MailController;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $uuid = Str::uuid()->getHex();
        // return dd($input);
        $instansi = $input['instansi'] == 'usni' ? $input['instansi'] : $input['instansi_lain'];
        $input['instansi_peserta'] = $instansi;

        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns',  'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password tidak sama',
        ])->validate();

        $pesertaData = [
            'no_telepon' => $input['no_telepon'],
            'instansi_peserta' => $instansi,
            'gender' => $input['gender'],
            'domisili' => $input['domisili'],
            'id_fakultas' => $input['id_fakultas'],
            'jurusan_peserta' => $input['jurusan_peserta'],
            'angkatan' => $input['angkatan'],
        ];

        if ($input['instansi'] == 'usni') {

            $validator =  Validator::make($pesertaData, [

                'instansi_peserta' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'gender' => 'in:male,female|nullable',
                'domisili' => 'string|max:255|nullable',
                'id_fakultas' => 'exists:fakultas,id|nullable',
                'jurusan_peserta' => 'string|nullable',
                'angkatan' => 'string|min:4|nullable',
            ])->validate();
        } else {
            $validator =  Validator::make($pesertaData, [

                'instansi_peserta' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                // 'tanggal_lahir' => 'string|max:255|nullable',
                'gender' => 'in:male,female|nullable',
                'domisili' => 'string|max:255|nullable',
            ])->validate();
        }


        MailController::userRegister($input['email'], $input['nama']);

        $user = User::create([
            'nama_user' => $input['nama'],
            'email' => $input['email'],
            'uuid' => $uuid,
            'password' => Hash::make($input['password']),
        ]);

        $validator['id_users'] = $user->id;
        Peserta::create($validator);
        return $user;
    }
}
