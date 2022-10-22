<?php

namespace Database\Seeders;

use App\Models\TipoRestauranteModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbcliente')->insert(
        array([
            'nomeCliente' => 'João da Silva',
            'cpfCliente' => '12345678901',
            'rgCliente' => '123456789',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'joao@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'nomeCliente' => 'Maria da Silva',
            'cpfCliente' => '12345678902',
            'rgCliente' => '123456780',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'maria@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'nomeCliente' => 'José da Silva',
            'cpfCliente' => '12345678903',
            'rgCliente' => '123456781',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'jose@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'nomeCliente' => 'Ana da Silva',
            'cpfCliente' => '12345678904',
            'rgCliente' => '123456782',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'ana@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'nomeCliente' => 'Pedro da Silva',
            'cpfCliente' => '12345678905',
            'rgCliente' => '123456783',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'pedro@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ],
        [
            'nomeCliente' => 'Paulo da Silva',
            'cpfCliente' => '12345678906',
            'rgCliente' => '123456784',
            'senhaCliente' => '123456',
            'fotoCliente' => '../../public/img/fotosPerfil/user.png',
            'emailCliente' => 'paulo@gmail.com',
            'cepCliente' => '12345678',
            'telefoneCliente' => '11999999999',
            'ruaCliente' => 'Rua da Silva',
            'numCasa' => '123',
            'bairroCliente' => 'Bairro da Silva',
            'cidadeCliente' => 'São Paulo',
            'estadoCliente' => 'SP',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ])
        );

        TipoRestauranteModel::factory()->count(10)->create();
    }
}