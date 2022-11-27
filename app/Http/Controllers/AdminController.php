<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel;
use App\Models\RestauranteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index() {
        $login = Session::get('login');
        if($login != 'admin') {
            return redirect('index');
        }

        $quantidadeCliente = ClienteModel::count();
        $quantidadeRestaurante = RestauranteModel::count();

        $graficoMes = $this->getGraphMeses();
        $graficoValorRestaurantes = $this->getGraphRestaurantesValor();
        $graficoValorReservas = $this->getGraphReservasValor();
        $graficoValorClientes = $this->getGraphClientesValor();

        return view('admin.dashboard', compact('quantidadeCliente', 'quantidadeRestaurante', 'graficoMes', 'graficoValorRestaurantes', 'graficoValorReservas', 'graficoValorClientes'));
    }

    public function pagrestaurantes() {
        $login = Session::get('login');
        if($login != 'admin') {
            return redirect('index');
        }

        $restaurantes = RestauranteModel::paginate(5);
            
        return view('admin.restaurantes', compact('restaurantes'));
    }

    public function pagclientes() {
        $login = Session::get('login');
        if($login != 'admin') {
            return redirect('index');
        }

        $clientes = ClienteModel::paginate(5);

        return view('admin.clientes', compact('clientes'));
    }

    public function getGraphMeses() {
        $mesAtual = date('m');

        if(($mesAtual - 6) < 0)
        {
            $aux = 12 - (6 - $mesAtual);
        }
        else{
            $aux = $mesAtual - 6;
        }

        $resultado = [];
        $meses = ['Janeiro','Fevereiro', 'Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        
        while($aux != $mesAtual){

            array_push($resultado, $meses[$aux]);

            if($aux == 11) $aux = 0;
            else $aux++;
        }

        return $resultado;
    }

    public function getGraphRestaurantesValor() {
        $mesAtual = date('m');

        if(($mesAtual - 6) < 0)
        {
            $aux = 12 - (6 - $mesAtual);
        }
        else{
            $aux = $mesAtual - 6;
        }
        $resultado = [];
        
        while($aux <= $mesAtual){
            array_push($resultado,  $this->getRestaurantespMes($aux + 1));
            $aux++;
        }

        return $resultado;
    }


    public function getGraphReservasValor() {
        $mesAtual = date('m');

        if(($mesAtual - 6) < 0)
        {
            $aux = 12 - (6 - $mesAtual);
        }
        else{
            $aux = $mesAtual - 6;
        }
        $resultadoReservas = [];
        
        while($aux <= $mesAtual){
            array_push($resultadoReservas,  $this->getReservaspMes($aux + 1));
            $aux++;
        }

        return $resultadoReservas;
    }

    public function getGraphClientesValor() {
        $mesAtual = date('m');

        if(($mesAtual - 6) < 0)
        {
            $aux = 12 - (6 - $mesAtual);
        }
        else{
            $aux = $mesAtual - 6;
        }
        $resultadoClientes = [];
        
        while($aux <= $mesAtual){
            array_push($resultadoClientes,  $this->getClientespMes($aux + 1));
            $aux++;
        }

        return $resultadoClientes;
    }

    private function getRestaurantespMes($mes)
    {
        $query = DB::table('tbrestaurante')
            ->select(DB::raw('COUNT(idRestaurante) AS total'))
            ->where(DB::raw('MONTH(created_at)'), '=', $mes)
            ->first()->total;

            return $query;
    }

    private function getReservaspMes($mes)
    {
        $reservas = DB::table('tbreserva')
            ->select(DB::raw('COUNT(idReserva) AS total'))
            ->where(DB::raw('MONTH(dataReserva)'), '=', $mes)
            ->first()->total;

        return $reservas;
    }

    private function getClientespMes($mes)
    {
        $clientes = DB::table('tbcliente')
            ->select(DB::raw('COUNT(idCliente) AS total'))
            ->where(DB::raw('MONTH(created_at)'), '=', $mes)
            ->first()->total;

            return $clientes;
    }

}
