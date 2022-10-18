<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\ReservaModel::class;

    public function definition()
    {
        return [
            'dataReserva' => $this->faker->dateTime(),
            'horaReserva' => $this->faker->time(),
            'numPessoas' => $this->faker->numberBetween(1, 10),
            'idStatusReserva' => $this->faker->numberBetween(1, 20),
            'idCliente' => $this->faker->numberBetween(1, 20),
            'idRestaurante' => $this->faker->numberBetween(1, 20),
            'idAvaliacao' => $this->faker->numberBetween(1, 20),
        ];
    }
}