<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\ClienteModel::class;

    public function definition()
    {
        return [
            'nomeCliente' => $this->faker->name(),
            'emailCliente' => $this->faker->unique()->safeEmail(),
            'senhaCliente' => $this->faker->password(),
            'cpfCliente' => $this->faker->cpf(),
            'rgCliente' => $this->faker->rg(),
            'cepCliente' => $this->faker->cep(),
            'telefoneCliente' => $this->faker->telefone(),
            'ruaCliente' => $this->faker->streetName(),
            'numCasa' => $this->faker->buildingNumber(),
            'bairroCliente' => $this->faker->city(),
            'cidadeCliente' => $this->faker->city(),
            'estadoCliente' => $this->faker->state(),
        ];
    }
}