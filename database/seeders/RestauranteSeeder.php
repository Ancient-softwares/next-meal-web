<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbrestaurante')->insert(
            array(
                [
                    'nomeRestaurante' => "Ragazzo",
                    'cnpjRestaurante' => "12345678901234",
                    'telRestaurante' => "1125555555",
                    'senhaRestaurante' => password_hash('123', PASSWORD_DEFAULT),
                    'fotoRestaurante' => "user.png",
                    'emailRestaurante' => "ragazzo@contato.com",
                    'cepRestaurante' => "08460360",
                    'ruaRestaurante' => "Rua Jaraguá do Sul",
                    'numRestaurante' => "10",
                    'bairroRestaurante' => "COHAB A",
                    'cidadeRestaurante' => "Gravataí",
                    'estadoRestaurante' => "RS",
                    'capacidadeRestaurante' => 30,
                    'lotacaoRestaurante' => false,
                    'idTipoRestaurante' => 1,
                    'horarioAberturaRestaurante' => "12:00:00",
                    'horarioFechamentoRestaurante' => "23:00:00",
                    'descricaoRestaurante' => "Ragazzo é um restaurante italiano que oferece uma experiência gastronômica única, com pratos que vão desde a culinária tradicional italiana até as mais modernas criações. O restaurante é um dos mais tradicionais da cidade, com mais de 20 anos de história e uma equipe de profissionais altamente qualificados. O ambiente é aconchegante e agradável, com uma decoração que remete à Itália, e a música ambiente é sempre apropriada para o momento. O restaurante é ideal para quem busca um ambiente agradável e uma experiência gastronômica única.",
                    'created_at' => '2022-08-10 21:46:28',
                    'updated_at' => '2022-08-10 21:46:28',
                ],
                [
                    'nomeRestaurante' => "Spoleto",
                    'cnpjRestaurante' => "98765432109876",
                    'telRestaurante' => "1123333333",
                    'senhaRestaurante' => password_hash('123', PASSWORD_DEFAULT),
                    'fotoRestaurante' => "user.png",
                    'emailRestaurante' => "spoleto@contato.com",
                    'cepRestaurante' => "08461110",
                    'ruaRestaurante' => "Rua Martins França",
                    'numRestaurante' => "10",
                    'bairroRestaurante' => "Além Ponte",
                    'cidadeRestaurante' => "Sorocaba",
                    'estadoRestaurante' => "SP",
                    'capacidadeRestaurante' => 40,
                    'lotacaoRestaurante' => false,
                    'idTipoRestaurante' => 2,
                    'horarioAberturaRestaurante' => "8:00:00",
                    'horarioFechamentoRestaurante' => "17:00:00",
                    'descricaoRestaurante' => "Spoleto é um restaurante italiano que oferece uma experiência gastronômica única, com pratos que vão desde a culinária tradicional italiana até as mais modernas criações. O restaurante é um dos mais tradicionais da cidade, com mais de 20 anos de história e uma equipe de profissionais altamente qualificados. O ambiente é aconchegante e agradável, com uma decoração que remete à Itália, e a música ambiente é sempre apropriada para o momento. O restaurante é ideal para quem busca um ambiente agradável e uma experiência gastronômica única.",
                    'created_at' => '2022-09-10 21:46:28',
                    'updated_at' => '2022-09-10 21:46:28',
                ],
                [
                    'nomeRestaurante' => "Pizzaria do Zé",
                    'cnpjRestaurante' => "12345678901234",
                    'telRestaurante' => "1125555555",
                    'senhaRestaurante' => password_hash('123', PASSWORD_DEFAULT),
                    'fotoRestaurante' => "user.png",
                    'emailRestaurante' => "zépizzaria@contato.net",
                    'cepRestaurante' => "94050010",
                    'ruaRestaurante' => "Rua Jaraguá do Sul",
                    'numRestaurante' => "10",
                    'bairroRestaurante' => "COHAB A",
                    'cidadeRestaurante' => "Gravataí",
                    'estadoRestaurante' => "RS",
                    'capacidadeRestaurante' => 30,
                    'lotacaoRestaurante' => false,
                    'idTipoRestaurante' => 3,
                    'horarioAberturaRestaurante' => "12:00:00",
                    'horarioFechamentoRestaurante' => "23:00:00",
                    "descricaoRestaurante" => "Pizzaria do Zé é uma pizzaria de bairro que busca oferecer as melhores pizzas da região por preços acessíveis.",
                    'created_at' => '2022-09-10 21:46:28',
                    'updated_at' => '2022-09-10 21:46:28',
                ],
                [
                    'nomeRestaurante' => "Bar do Armando",
                    'cnpjRestaurante' => "98765432109876",
                    'telRestaurante' => "1123333333",
                    'senhaRestaurante' => password_hash('123', PASSWORD_DEFAULT),
                    'fotoRestaurante' => "user.png",
                    'emailRestaurante' => "armanbar@outlook.com",
                    'cepRestaurante' => "18013270",
                    'ruaRestaurante' => "Rua Martins França",
                    'numRestaurante' => "10",
                    'bairroRestaurante' => "Guaianazes",
                    'cidadeRestaurante' => "São Paulo",
                    'estadoRestaurante' => "SP",
                    'capacidadeRestaurante' => 40,
                    'lotacaoRestaurante' => false,
                    'idTipoRestaurante' => 4,
                    'horarioAberturaRestaurante' => "8:00:00",
                    'horarioFechamentoRestaurante' => "17:00:00",
                    'descricaoRestaurante' => "Bar do Armando é um bar do povão.",
                    'created_at' => Date::now(),
                    'updated_at' => Date::now(),
                ],
            )
        );
    }
}
