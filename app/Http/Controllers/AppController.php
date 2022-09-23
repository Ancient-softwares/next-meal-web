<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservaModel;
use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    private $reservas;
    private $restaurantes;
    private $clientes;
    private $tipoRestaurante;

    public function __construct()
    {
        $this->reservas = new ReservaModel();
        $this->restaurantes = new RestauranteModel();
        $this->clientes = new ClienteModel();
        $this->tipoRestaurante = new TipoRestauranteModel();
    }

    public function reserva(Request $request) {
        $dataReserva = $request->dataReserva;
        $horaReserva = $request->horaReserva;
        $numPessoas = $request->numPessoas;

        $reserva = $this->reservas->create([
            "dataReserva" => $dataReserva,
            "horaReserva" => $horaReserva,
            "numPessoas" => $numPessoas
        ]);
    }

    public function getRestaurants() {
        $restaurantes = $this->restaurantes->all();
        $tipoRestaurante = TipoRestauranteModel::select('tbtiporestaurante.idTipoRestaurante', 'tbtiporestaurante.tipoRestaurante')
        ->join('tbrestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
        ->get(); // or first() 
        
        return response()->json([$restaurantes, $tipoRestaurante]);
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
            return $request.json_encode($cad);
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
}
