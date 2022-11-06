<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\ReservaModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{

    private $restaurantes;

    public function __construct()
    {
        $this->restaurantes = new RestauranteModel();
    }
    
    public function indexLogin() {
        $login = Session::get('login');
        if(isset($login)) {
            return redirect('index');
        }
        $tipos = TipoRestauranteModel::all();

        return view('login', compact('tipos'));
    }


    public function registrar(Request $request)
    {
        $senha = $request->senha;
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $telefone = $request->telefone;
        $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
        $telefone = str_replace('-', '', $telefone);
        
        $cep = $request->cep;
        $cep = str_replace('-', '', $cep);

        $cnpj = $request->cnpj;
        $cnpj = str_replace('-', '', $cep);
        $cnpj = str_replace('.', '', $cep);
        $cnpj = str_replace('/', '', $cep);


        $cad = $this->restaurantes->create([
            'nomeRestaurante' => $request->nome,
            'cnpjRestaurante' => $cnpj,
            'telRestaurante' => $telefone,
            'loginRestaurante' => $request->login,
            'senhaRestaurante' => $senha,
            'fotoRestaurante' => "user.png",
            'emailRestaurante' => $cnpj,
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->rua,
            'numRestaurante' => $request->numero,
            'bairroRestaurante' => $request->bairro,
            'cidadeRestaurante' => $request->cidade,
            'estadoRestaurante' => $request->uf,
            'capacidadeRestaurante' => $request->capacidade,
            'horarioAberturaRestaurante' => $request->horarioabertura,
            'horarioFechamentoRestaurante' => ($request->horariofechamento . ":00"),
            'ocupacaoRestaurante' => 1,
            'descricaoRestaurante' => '--',
            'idTipoRestaurante' => $request->tipoRestaurante,
        ]);

        if($cad) {
            return redirect()->back();
        }
    }

    public function autenticar(Request $request) {
        $restaurante = $this->restaurantes->where('nomeRestaurante', '=', $request->login)->first();

        if($restaurante) {
            if(password_verify($request->senha, $restaurante->senhaRestaurante)) {
                Session::put('login', $request->login);
                Session::put('idRestaurante', $restaurante->idRestaurante);

                return redirect("index");
            }
        }

        return redirect()->back()->withErrors('Login inválido!');
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }

}
