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
        array([
            'dtAvaliacao' => Date::now(),
            'notaAvaliacao' => 5,
            'descAvaliacao' => 'Primeira descrição da avaliação',
            'idRestaurante' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'dtAvaliacao' => Date::now(),
            'notaAvaliacao' => 4,
            'descAvaliacao' => 'Segunda descrição da avaliação',
            'idRestaurante' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'dtAvaliacao' => Date::now(),
            'notaAvaliacao' => 3,
            'descAvaliacao' => 'Terceira descrição da avaliação',
            'idRestaurante' => 2,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'dtAvaliacao' => Date::now(),
            'notaAvaliacao' => 2,
            'descAvaliacao' => 'Quarta descrição de avaliação',
            'idRestaurante' => 2,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );

    }
}