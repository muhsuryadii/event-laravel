<?php

namespace Database\Factories;

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
            'harga_tiket' => $this->faker->numberBetween(100000, 1000000),
            'tanggal_acara' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'lokasi_acara' => 'Google Meet',
            'tipe_acara' => 'Online'
        ];
    }
}
