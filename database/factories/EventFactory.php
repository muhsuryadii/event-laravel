<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_panitia' => $this->faker->numberBetween(1, 5),
            'nama_event' => $this->faker->sentence,

            'uuid' => Str::uuid()->getHex(),
            'harga_tiket' => $this->faker->numberBetween(100000, 1000000),
            'waktu_acara' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'lokasi_acara' => 'Google Meet',
            'kuota_tiket' => $this->faker->numberBetween(50, 200),
            'tipe_acara' => 'Online',
            'deskripsi_acara' => $this->faker->paragraph,
        ];
    }
}
