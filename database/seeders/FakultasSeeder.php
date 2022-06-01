<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fakultas::create([
            'nama' => 'Fakultas Teknik',
        ]);

        Fakultas::create([
            'nama' => 'Fakultas Ekonomi',
        ]);

        Fakultas::create([
            'nama' => 'Fakultas Ilmu Sosial dan Ilmu Politik',
        ]);

        Fakultas::create([
            'nama' => 'Fakultas Perikanan',
        ]);
        Fakultas::create([
            'nama' => 'Fakultas Hukum',
        ]);
    }
}
