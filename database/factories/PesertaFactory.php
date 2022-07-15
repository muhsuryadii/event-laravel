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
        $instansi = $this->faker->randomElement(['usni', $this->faker->company]);
        $angkatan =  $instansi == 'usni' ?  $this->faker->numberBetween(2010, 2022) : null;
        $id_fakultas =  $instansi == 'usni' ?  $this->faker->numberBetween(1, 5) : null;
        $jurusan_peserta =  $instansi == 'usni' ?  $this->faker->jobTitle : null;

        return [
            'id_users' => $this->faker->unique()->numberBetween(7, 106),
            'instansi_peserta' => $instansi,
            'no_telepon' => $this->faker->phoneNumber,
            'tanggal_lahir' => $this->faker->date,
            'domisili' => $this->faker->city,
            'gender' =>  $this->faker->randomElement(['male', 'female']),
            'angkatan' =>   $angkatan,
            'id_fakultas' => $id_fakultas,
            'jurusan_peserta' => $jurusan_peserta,
        ];
    }
}
