<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbmesa')->insert(
        array([
            'numMesa' => 1,
            'quantAcentosMesa' => 4,
            'idRestaurante' => 1,
            'statusMesa' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'numMesa' => 2,
            'quantAcentosMesa' => 6,
            'idRestaurante' => 1,
            'statusMesa' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'numMesa' => 3,
            'quantAcentosMesa' => 10,
            'idRestaurante' => 1,
            'statusMesa' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'numMesa' => 4,
            'quantAcentosMesa' => 4,
            'idRestaurante' => 1,
            'statusMesa' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'numMesa' => 5,
            'quantAcentosMesa' => 4,
            'idRestaurante' => 1,
            'statusMesa' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );
    }
}