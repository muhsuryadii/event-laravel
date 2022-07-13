<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PanitiaSeeder::class,
            UserSeeder::class,
            FakultasSeeder::class,
            EventSeeder::class,
            TransaksiSeeder::class,
            // LaporanSeeder::class
        ]);
    }
}
