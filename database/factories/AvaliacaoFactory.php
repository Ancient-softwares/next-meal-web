<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\AvaliacaoModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AvaliacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = AvaliacaoModel::class;

    public function definition()
    {
        $create = AvaliacaoModel::factory()->count(20)->create();
        
        return [
            'dtAvaliacao' => $this->faker->dateTime(),
            'notaAvaliacao' => $this->faker->numberBetween(1, 5),
            'descAvaliacao' => $this->faker->text(100),
            'idRestaurante' => $this->faker->numberBetween(1, 20),
            'idCliente' => $this->faker->numberBetween(1, 20),
        ];
    }
}