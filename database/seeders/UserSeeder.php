<?php

namespace Database\Seeders;

use App\Models\Panitia;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'uuid' => Str::uuid()->getHex(),


            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'ADMIN',
        ]);

        /* Factory Users */
        User::factory(100)->create();
        Peserta::factory(100)->create();
    }
}
