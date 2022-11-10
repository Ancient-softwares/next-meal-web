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
        $cnpj = str_replace('-', '', $cnpj);
        $cnpj = str_replace('.', '', $cnpj);
        $cnpj = str_replace('/', '', $cnpj);

        $restauranteExiste = RestauranteModel::where('emailRestaurante', $request->email)->first();
        if($restauranteExiste) {
            return redirect()->back()->withErrors('E-mail já cadastrado');
        }


        $cad = $this->restaurantes->create([
            'nomeRestaurante' => $request->nome,
            'cnpjRestaurante' => $cnpj,
            'telRestaurante' => $telefone,
            'emailRestaurante' => $request->email,
            'senhaRestaurante' => $senha,
            'fotoRestaurante' => "user.png",
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->rua,
            'numRestaurante' => $request->numero,
            'bairroRestaurante' => $request->bairro,
            'cidadeRestaurante' => $request->cidade,
            'estadoRestaurante' => $request->uf,
            'capacidadeRestaurante' => $request->capacidade,
            'lotacaoRestaurante' => false,
            'horarioAberturaRestaurante' => $request->horarioabertura,
            'horarioFechamentoRestaurante' => ($request->horariofechamento . ":00"),
            'descricaoRestaurante' => '--',
            'idTipoRestaurante' => $request->tipoRestaurante,
        ]);

        if($cad) {
            return redirect()->back();
        }
    }

    public function autenticar(Request $request) {
        $restaurante = $this->restaurantes->where('emailRestaurante', '=', $request->email)->first();

        if($restaurante) {
            if(password_verify($request->senha, $restaurante->senhaRestaurante)) {
                Session::put('login', $request->email);
                Session::put('idRestaurante', $restaurante->idRestaurante);

                return redirect("index");
            }
        }

        if($request->email == "admin@admin.com" && $request->senha == 123) {
            Session::put('login', 'admin');
            return redirect("admin");
        }

        return redirect()->back()->withErrors('Login inválido!');
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }

}
