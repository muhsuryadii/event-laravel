<?php

namespace Database\Seeders;

use App\Models\Panitia;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PanitiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_user' => 'BEM Fakultas Teknik',
            'email' => 'teknik@example.com',
            'uuid' => Str::uuid()->getHex(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'PANITIA',
        ]);

        Panitia::create([
            'id_users' => '1',
            'id_fakultas' => '1'
        ]);

        User::create([
            'nama_user' => 'BEM Fakultas Ekonomi',
            'email' => 'ekonomi@example.com',
            'uuid' => Str::uuid()->getHex(),


            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'PANITIA',
        ]);

        Panitia::create([
            'id_users' => '2',
            'id_fakultas' => '2'
        ]);

        User::create([
            'nama_user' => 'BEM Fakultas FISIP',
            'email' => 'fisip@example.com',
            'uuid' => Str::uuid()->getHex(),


            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'PANITIA',
        ]);

        Panitia::create([
            'id_users' => '3',
            'id_fakultas' => '3'
        ]);

        User::create([
            'nama_user' => 'BEM Fakultas Perikanan',
            'email' => 'perikanan@example.com',
            'uuid' => Str::uuid()->getHex(),


            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'PANITIA',
        ]);

        Panitia::create([
            'id_users' => '4',
            'id_fakultas' => '4'
        ]);
        User::create([
            'nama_user' => 'BEM Fakultas Hukum',
            'email' => 'hukum@example.com',
            'uuid' => Str::uuid()->getHex(),

            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'PANITIA',
        ]);

        Panitia::create([
            'id_users' => '5',
            'id_fakultas' => '5'
        ]);
    }
}
