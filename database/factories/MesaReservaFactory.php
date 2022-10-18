<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MesaReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\MesaReservaModel::class;

    public function definition()
    {
        return [
            'idReserva' => $this->faker->numberBetween(1, 20),
            'idMesa' => $this->faker->numberBetween(1, 20),
            'idCliente' => $this->faker->numberBetween(1, 20),
        ];
    }
}