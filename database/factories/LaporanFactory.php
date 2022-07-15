<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LaporanFactory extends Factory
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
            'status_absen' => $this->faker->randomElement([true, false]),
            'id_transaksi' => $this->faker->numberBetween(1, 50),
        ];
    }
}
