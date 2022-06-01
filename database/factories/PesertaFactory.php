<?php

namespace Database\Factories;

use App\Models\Peserta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Peserta::class;

    public function definition()
    {
        return [
            'id_users' => $this->faker->numberBetween(7, 11),
            'id_fakultas' => $this->faker->numberBetween(1, 5),
            'instansi_peserta' => $this->faker->company,
            'no_telepon' => $this->faker->phoneNumber,
            'jurusan_peserta' => $this->faker->jobTitle,
            'tahun_masuk' => $this->faker->numberBetween(2010, 2020),
        ];
    }
}
