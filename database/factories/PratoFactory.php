<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\PratoModel::class;

    public function definition()
    {
        return [
            'nomePrato' => $this->faker->name(),
            'ingredientePrato' => $this->faker->shuffleArray([
                'Arroz',
                'Feijão',
                'Carne',
                'Frango',
                'Batata',
                'Macarrão',
                'Salada',
                'Cebola',
                'Alface',
                'Tomate',
                'Pimentão',
                'Cenoura',
                'Beterraba',
                'Batata Doce',
                'Batata Frita',
                'Batata Palha',
                'Batata Rústica',
                'Batata Salsa',
                'Batata Sarraceno',
                'Batata Sautée',
                'Batata Sopa',
                'Batata Suíça',
                'Batata Tufada',
                'Batata Viena',
                'Batata Yúca',
                'Batata Zé do Caixão',
                'Batata Zé do Pipo',
            ]),
            'valorPrato' => $this->faker->randomFloat(2, 1, 100),
            'fotoPrato' => $this->faker->imageUrl(640, 480, 'food', true),
            'idRestaurante' => $this->faker->numberBetween(1, 20),
            'idTipoPrato' => $this->faker->numberBetween(1, 20),
        ];
    }
}