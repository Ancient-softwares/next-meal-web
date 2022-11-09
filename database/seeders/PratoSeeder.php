<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbprato')->insert(
            array(
                [
                    'nomePrato' => 'Bife à Parmegiana',
                    'valorPrato' => 25.00,
                    'ingredientesPrato' => 'Bife, molho de tomate, queijo parmesão, batata palha',
                    'fotoPrato' => 'parmegiana.jpg',
                    'idRestaurante' => 1,
                    'idTipoPrato' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'nomePrato' => 'Bife à Milanesa',
                    'valorPrato' => 25.00,
                    'ingredientesPrato' => 'Bife, molho de tomate, queijo parmesão, batata palha',
                    'fotoPrato' => 'milanesa.jpg',
                    'idRestaurante' => 1,
                    'idTipoPrato' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'nomePrato' => 'Bife à Rolê',
                    'valorPrato' => 25.00,
                    'ingredientesPrato' => 'Bife, molho de tomate, queijo parmesão, batata palha',
                    'fotoPrato' => 'role.jpg',
                    'idRestaurante' => 2,
                    'idTipoPrato' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'nomePrato' => 'Bife à Portuguesa',
                    'valorPrato' => 25.00,
                    'ingredientesPrato' => 'Bife, molho de tomate, queijo parmesão, batata palha',
                    'fotoPrato' => 'portuguesa.jpg',
                    'idRestaurante' => 2,
                    'idTipoPrato' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'nomePrato' => 'Bife à Moda da Casa',
                    'valorPrato' => 25.00,
                    'ingredientesPrato' => 'Bife, molho de tomate, queijo parmesão, batata palha',
                    'fotoPrato' => 'casa.jpg',
                    'idRestaurante' => 3,
                    'idTipoPrato' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
                [
                    'nomePrato' => 'Batata Frita',
                    'valorPrato' => 10.00,
                    'ingredientesPrato' => 'Batata, óleo, sal',
                    'fotoPrato' => 'batatafrita.jpg',
                    'idRestaurante' => 4,
                    'idTipoPrato' => 2,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),

                ],
                [
                    'nomePrato' => 'Batata Rústica',
                    'valorPrato' => 10.00,
                    'ingredientesPrato' => 'Batata, óleo, sal',
                    'fotoPrato' => 'batatarustica.jpg',
                    'idRestaurante' => 4,
                    'idTipoPrato' => 3,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
                ]
            )
        );
    }
}
