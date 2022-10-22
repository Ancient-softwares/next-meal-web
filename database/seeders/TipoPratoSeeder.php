<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TipoPratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbtipoprato')->insert(
        array([
            'tipoPrato' => 'Entrada',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoPrato' => 'Prato Principal',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoPrato' => 'Sobremesa',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoPrato' => 'Bebida',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'tipoPrato' => 'Outros',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );
    }
}