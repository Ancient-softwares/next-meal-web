<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\AvaliacaoModel;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbavaliacao')->insert(
            array(
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 5,
                    'descAvaliacao' => 'Restaurante excelente! voltarei mais vezes',
                    'idRestaurante' => 1,
                    'idCliente' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 4,
                    'descAvaliacao' => 'Amei as massas, mas o atendimento não me agradou muito',
                    'idRestaurante' => 1,
                    'idCliente' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 1,
                    'descAvaliacao' => 'A comida veio fria e fui atendido muito mal',
                    'idRestaurante' => 2,
                    'idCliente' => 3,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 1,
                    'descAvaliacao' => 'Pessimo restaurante, local nada agradavel e muito sujo',
                    'idRestaurante' => 2,
                    'idCliente' => 4,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 3,
                    'descAvaliacao' => 'Comida não me agradou muito, poderiam investir mais nos ingredientes',
                    'idRestaurante' => 3,
                    'idCliente' => 5,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 2,
                    'descAvaliacao' => 'Os garçons estavam perdidos e demoraram para trazer a comida',
                    'idRestaurante' => 3,
                    'idCliente' => 6,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 5,
                    'descAvaliacao' => 'Eu amei o ambiente, a pizza estava perfeita e fui super bem atendide',
                    'idRestaurante' => 4,
                    'idCliente' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 4,
                    'descAvaliacao' => 'Pizzaria muito boa, gostei dos sabores das pizzas!!!',
                    'idRestaurante' => 5,
                    'idCliente' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 3,
                    'descAvaliacao' => 'O local estava muito cheio e passei 25 minutos para ser atendido',
                    'idRestaurante' => 6,
                    'idCliente' => 3,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                
                [
                    'dtAvaliacao' => Date::now(),
                    'notaAvaliacao' => 5,
                    'descAvaliacao' => 'O local estava cheio mas fui atendido e as esfirras estavam muito boas!!!',
                    'idRestaurante' => 8,
                    'idCliente' => 3,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ]
                )
        );
    }
}
