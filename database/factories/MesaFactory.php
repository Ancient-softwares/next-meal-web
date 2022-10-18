<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\MesaModel::class;

    public function definition()
    {
        return [
            'numMesa' => $this->faker->numberBetween(1, 20),
            'quantAcentosMesa' => $this->faker->numberBetween(1, 10),
            'statusMesa' => $this->faker->boolean(),
            'idRestaurante' => $this->faker->numberBetween(1, 20),
        ];
    }
}