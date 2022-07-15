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

        $jurusan_teknik = $this->faker->randomElement(['Sistem Informasi', 'Teknik Informatika', 'Teknik Lingkungan', 'Manajemen Informatika']);
        $jurusan_ekonomi = $this->faker->randomElement(['Manajemen', 'Akuntansi']);
        $jurusan_fisip = $this->faker->randomElement(['Ilmu Hubungan Internasional', 'Ilmu Komunikasi']);
        $jurusan_perikanan = $this->faker->randomElement(['Pemanfaatan Sumberdaya Perikanan', 'Akuakultur']);
        $jurusan_hukum =   $this->faker->randomElement(['Hukum']);

        $jurusanFix = $id_fakultas == 1 ?  $jurusan_teknik : ($id_fakultas == 2 ? $jurusan_ekonomi : ($id_fakultas == 3 ?  $jurusan_fisip : ($id_fakultas == 4 ?  $jurusan_perikanan : $jurusan_hukum)));

        $jurusan_peserta =  $instansi == 'usni' ?  $jurusanFix : null;

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
