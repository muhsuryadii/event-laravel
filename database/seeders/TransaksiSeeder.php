<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Transaksi::factory(50)->create();
        $faker = app(Generator::class);

        for ($i = 1; $i <= 1000; $i++) {
            $id_event = $faker->numberBetween(1, 50);
            $id_peserta = $faker->numberBetween(7, 106);

            $transaksi = DB::table('transaksis')->where('id_event', $id_event)->where('id_peserta', $id_peserta)->first();

            if ($transaksi) {
                $id_peserta = $faker->numberBetween(7, 106);

                $transaksi = DB::table('transaksis')->where('id_event', $id_event)->where('id_peserta', $id_peserta)->first();

                if ($transaksi) continue;
            }

            $event = DB::table('events')->where('id', $id_event)->first();

            $transaksi = Transaksi::create([
                'uuid' => Str::uuid()->getHex(),
                'id_event' =>  $id_event,
                'id_peserta' => $id_peserta,
                'tanggal_transaksi' => $faker->dateTimeBetween('now', '+1 week'),
                'total_harga' =>  $event->harga_tiket,
                'waktu_pembayaran' => $faker->dateTimeBetween('now', '+1 week'),
                'no_transaksi' => $faker->creditCardNumber(),
                'status_transaksi' => 'verified',
            ]);

            $id_transaksi = $transaksi->id;

            Laporan::create([
                'uuid' => Str::uuid()->getHex(),
                'id_event' => $id_event,
                'id_peserta' => $id_peserta,
                'status_absen' => $faker->randomElement([true, false]),
                'id_transaksi' => $id_transaksi,
            ]);
        }
    }
}
