<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TipoRestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbtiporestaurante')->insert(
        array([
            'tipoRestaurante' => 'Restaurante',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoRestaurante' => 'Bar',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoRestaurante' => 'Lanchonete',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoRestaurante' => 'Cafeteria',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoRestaurante' => 'Outros',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );
    }
}