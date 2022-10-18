<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TipoRestauranteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\TipoRestauranteModel::class;

    public function definition()
    {
        return [
            'tipoRestaurante' => $this->faker->text(20),
        ];
    }
}