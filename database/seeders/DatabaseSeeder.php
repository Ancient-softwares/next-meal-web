<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClienteSeeder::class,
            TipoPratoSeeder::class,
            TipoRestauranteSeeder::class,
            StatusReservaSeeder::class,
            RestauranteSeeder::class,
            PratoSeeder::class,
            AvaliacaoSeeder::class,
            MesaSeeder::class,
            ReservaSeeder::class,
            MesaReservaSeeder::class,
        ]);
    }
}
