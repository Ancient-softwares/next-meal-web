<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class StatusReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbstatusreserva')->insert(
            array(
                [
                    'statusReserva' => 'Confirmado',
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'statusReserva' => 'Cancelado',
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'statusReserva' => 'Aguardando',
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'statusReserva' => 'Finalizado',
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
            )
        );
    }
}
