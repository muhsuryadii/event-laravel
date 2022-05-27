<?php

namespace Database\Factories;

use App\Models\Panitia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PanitiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Panitia::class;

    public function definition()
    {
        return [
            'id_users' => $this->faker->numberBetween(1, 5),
            'id_fakultas' => $this->faker->numberBetween(1, 6),
        ];
    }
}
