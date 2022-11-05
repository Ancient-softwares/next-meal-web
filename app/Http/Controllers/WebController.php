<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{

    private $restaurantes;

    public function __construct()
    {
        $this->restaurantes = new RestauranteModel();
    }

    public function indexLogin()
    {
        $login = Session::get('login');
        if (isset($login)) {
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

        $cad = $this->restaurantes->create([
            'nomeRestaurante' => $request->nome,
            'cnpjRestaurante' => "--",
            'telRestaurante' => $telefone,
            'loginRestaurante' => $request->login,
            'senhaRestaurante' => $senha,
            'fotoRestaurante' => "user.png",
            'emailRestaurante' => "--",
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->rua,
            'numRestaurante' => $request->numero,
            'bairroRestaurante' => $request->bairro,
            'cidadeRestaurante' => $request->cidade,
            'estadoRestaurante' => $request->uf,
            'capacidadeRestaurante' => 1,
            'idTipoRestaurante' => 1,
        ]);

        if ($cad) {
            return redirect()->back();
        }
    }

    public function autenticar(Request $request)
    {
        $restaurante = $this->restaurantes->where('nomeRestaurante', '=', $request->login)->first();

        if ($restaurante) {
            if (password_verify($request->senha, $restaurante->senhaRestaurante)) {
                Session::put('login', $request->login);
                Session::put('idRestaurante', $restaurante->idRestaurante);

                return redirect("index");
            }
        }

        return redirect()->back()->withErrors('Login inválido!');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }

    public function dashboard()
    {
        $login = Session::get('login');

        if (!isset($login)) {
            return redirect()->route('login');
        }

        return view('index', compact('login'));
    }
}
