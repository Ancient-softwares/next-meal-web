<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;

class WebController extends Controller
{

    private $restaurantes;

    public function __construct()
    {
        $this->restaurantes = new RestauranteModel();
    }
    
    public function indexLogin(Request $request) {
        $login = $request->session()->get("login");
        if(isset($login)) {
            return redirect('index');
        }

        $tipos = TipoRestauranteModel::all();

        return view('login', compact('tipos'));
    }

    public function indexRegistro(Request $request)
    {
        return view("registrar");
    }

    public function teste(Request $request) {
        return 'Gostosun tesntin';
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
            "nomeRestaurante" => $request->nome,
            "telRestaurante" => $telefone,
            "cepRestaurante" => $cep,
            "senhaRestaurante" => $senha
        ]);

        if($cad) {
            return redirect()->back();
        }
    }

    public function autenticar(Request $request) {
        $restaurante = $this->restaurantes->where('nomeRestaurante', '=', $request->login)->first();

        

        if($restaurante) {
            if(password_verify($request->senha, $restaurante->senhaRestaurante)) {
                $request->session()->put('login', $request->login);
                $request->session()->put('idRestaurante', $restaurante->idRestaurante);

                return redirect("index");
            }
        }

        return redirect()->back()->withErrors('Login inválido!');
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/');
    }

    public function dashboard(Request $request) {
        $login = $request->session()->get('login');
        if(!isset($login)) {
            return redirect()->back();
        }

        return view('index', compact('login'));
    }
}
