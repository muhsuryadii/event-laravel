<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'uuid' => Str::uuid()->getHex(),
            'id_event' => $this->faker->numberBetween(1, 20),
            'id_peserta' => $this->faker->numberBetween(7, 26),
            'tanggal_transaksi' => $this->faker->dateTimeBetween('now', '+1 week'),
            'total_harga' => $this->faker->randomElement([0, $this->faker->numberBetween(100000, 1000000)]),
            'waktu_pembayaran' => $this->faker->dateTimeBetween('now', '+1 week'),
            'no_transaksi' => $this->faker->creditCardNumber(),
            'status_transaksi' => 'verified',
        ];
    }
}
