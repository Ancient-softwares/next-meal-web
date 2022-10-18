<?php

namespace Database\Seeders;

use App\Models\MesaModel;
use App\Models\MesaReservaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MesaReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbmesareserva')->insert(
        array([
            'idMesa' => 1,
            'idReserva' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'idMesa' => 2,
            'idReserva' => 2,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'idMesa' => 3,
            'idReserva' => 3,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'idMesa' => 4,
            'idReserva' => 4,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );

    }
}