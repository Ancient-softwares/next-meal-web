<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RestauranteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\RestauranteModel::class;

    public function definition()
    {
        return [
            'nomeRestaurante' => $this->faker->name(),
            'cnpjRestaurante' => $this->faker->cpf(),
            'telRestaurante' => $this->faker->phoneNumber(),
            'emailRestaurante' => $this->faker->email(),
            'cepRestaurante' => $this->faker->postcode(),
            'logradouroRestaurante' => $this->faker->streetName(),
            'numeroRestaurante' => $this->faker->buildingNumber(),
            'bairroRestaurante' => $this->faker->city(),
            'cidadeRestaurante' => $this->faker->city(),
            'estadoRestaurante' => $this->faker->state(),
            'senhaRestaurante' => $this->faker->password(),
            'loginRestaurante' => $this->faker->userName(),
            'fotoRestaurante' => $this->faker->imageUrl(640, 480, 'restaurant', true),
            'capMaximaRestaurante' => $this->faker->numberBetween(1, 100),
            'idTipoRestaurante' => $this->faker->numberBetween(1, 20),
        ];
    }
}