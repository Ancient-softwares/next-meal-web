<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbreserva')->insert(
            array(
                [
                    'dataReserva' => Date::now(),
                    'horaReserva' => '12:00:00',
                    'numPessoas' => 4,
                    'idCliente' => 1,
                    'idRestaurante' => 2,
                    'idStatusReserva' => 4,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => Date::now(),
                    'horaReserva' => '13:00:00',
                    'numPessoas' => 3,
                    'idCliente' => 2,
                    'idRestaurante' => 2,
                    'idStatusReserva' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => Date::now(),
                    'horaReserva' => '14:00:00',
                    'numPessoas' => 3,
                    'idCliente' => 2,
                    'idRestaurante' => 1,
                    'idStatusReserva' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => Date::now(),
                    'horaReserva' => '15:00:00',
                    'numPessoas' => 2,
                    'idCliente' => 3,
                    'idRestaurante' => 1,
                    'idStatusReserva' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => Date::now(),
                    'horaReserva' => '16:00:00',
                    'numPessoas' => 2,
                    'idCliente' => 1,
                    'idRestaurante' => 4,
                    'idStatusReserva' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ]
            )
        );
    }
}
