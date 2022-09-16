<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $restaurantes;
    private $clientes;

    public function __construct()
    {
        $this->restaurantes = new RestauranteModel();
        $this->clientes = new ClienteModel();
    }
    
    public function indexLogin(Request $request) {
        $login = $request->session()->get("login");
        if(isset($login)) {
            return redirect('index');
        }

        return view('login');
    }

    public function indexRegistro(Request $request)
    {
        return view("registrar");
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

    public function testeMobile(Request $request) {
        return 'Gostosun tesntin';
    }

    public function cadastroCliente(Request $request) {
        $senha = $request->senha;
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $celCliente = $request->celCliente;
        $celCliente = preg_replace('/[^A-Za-z0-9\-]/', '', $celCliente);
        $celCliente = str_replace('-', '', $celCliente);

        $cpf = $request->cpfCliente;
        $cpf = preg_replace('/[^A-Za-z0-9\-]/', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        
        $cep = $request->cepCliente;
        $cep = str_replace('-', '', $cep);

        // dd($request);

        $cad = $this->clientes->create([
            "nomeCliente" => $request->nomeCliente,
            "cpfCliente" => $cpf,
            "celCliente" => $celCliente,
            "senhaCliente" => $request->senhaCliente,
            "fotoCliente" => $request->fotoCliente,
            "emailCliente" => $request->emailCliente,
            "cepCliente" => $cep,
            "ruaCliente" => $request->ruaCliente,
            "numCasa" => $request->numCasa,
            "bairroCliente" => $request->bairroCliente,
            "cidadeCliente" => $request->cidadeCliente,
            "estadoCliente" => $request->estadoCliente
        ]);

        if($cad) {
            // return $request.json_encode($cad);
            return $request;
        } else {
            return false;
        }
    }

    public function loginCliente(Request $request){
        $cliente = $this->clientes->where('emailCliente', '=', $request->login)->first();

        if($cliente) {
            if(password_verify($request->senha, $cliente->senhaCliente)) {
                $request->session()->put('login', $request->login);
                $request->session()->put('idCliente', $cliente->idCliente);

                return redirect("index");
            }
        }

        return redirect()->back()->withErrors('Login inválido!');
    }

    public function soma(Request $request) {
        $n1 = $request->n1;
        $n2 = $request->n2;
        
        return $n1 + $n2;
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
