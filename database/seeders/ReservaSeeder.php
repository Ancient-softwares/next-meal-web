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
                    'dataReserva' => '2022-01-01',
                    'horaReserva' => '12:00:00',
                    'numPessoas' => 4,
                    'idCliente' => 1,
                    'idRestaurante' => 2,
                    'idStatusReserva' => 4,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => '2017-12-12',
                    'horaReserva' => '12:00:00',
                    'numPessoas' => 6,
                    'idCliente' => 1,
                    'idRestaurante' => 4,
                    'idStatusReserva' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => '2021-05-01',
                    'horaReserva' => '12:00:00',
                    'numPessoas' => 12,
                    'idCliente' => 1,
                    'idRestaurante' => 3,
                    'idStatusReserva' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => '2018-04-07',
                    'horaReserva' => '13:00:00',
                    'numPessoas' => 3,
                    'idCliente' => 2,
                    'idRestaurante' => 2,
                    'idStatusReserva' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => '2019-11-09',
                    'horaReserva' => '14:00:00',
                    'numPessoas' => 3,
                    'idCliente' => 2,
                    'idRestaurante' => 1,
                    'idStatusReserva' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'dataReserva' => '2020-07-08',
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
