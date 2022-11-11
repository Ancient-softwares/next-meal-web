<?php

namespace App\Http\Controllers;

use App\Models\ReservaModel;
use App\Models\RestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index() {
        $login = Session::get('login');

        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }
        
        $restaurante = RestauranteModel::where("emailRestaurante", Session::get('login'))->first();
        
        $fieis = DB::table('tbreserva')
            ->select('tbcliente.nomeCliente', DB::raw('count(tbreserva.idCliente) as totalReservas'))
            ->join('tbcliente', 'tbreserva.idCliente', '=', 'tbcliente.idCliente')
            ->where('tbreserva.idRestaurante', '=', Session::get('idRestaurante'))
            ->where('tbreserva.idStatusReserva', '=', 1)
            ->groupBy('tbcliente.nomeCliente')
            ->orderBy('totalReservas', 'desc')
            ->limit(3)
            ->get();
        

        $recentes = $this->getClientesRecentes(Session::get('idRestaurante'));
        
        $graficoMes = $this->getGraphReservasMes();
        $graficoValor = $this->getGraphReservasValor();

        $reservas = ReservaModel::where('idRestaurante', Session::get('idRestaurante'))->where('idStatusReserva', 1)->get()->count();
        $clientesRecentes = ReservaModel::all()->max();
        return view('index', compact('reservas', 'clientesRecentes', 'fieis', 'graficoMes', 'graficoValor', 'recentes'));   
    }

    public function getClientesRecentes($idRestaurante)
    {
        $query = DB::table('tbreserva')
            ->select('tbcliente.nomeCliente', DB::raw('max(tbreserva.idCliente) as recentes'))
            ->join('tbcliente', 'tbreserva.idCliente', '=', 'tbcliente.idCliente')
            ->where('tbreserva.idRestaurante', '=', $idRestaurante)
            ->groupBy('tbcliente.nomeCliente')
            ->orderBy('recentes', 'desc')
            ->limit(3)
            ->get();

        return $query;
    }

    public function getGraphReservasMes() {
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

    public function getGraphReservasValor() {
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
            array_push($resultado,  $this->getReservapMes($aux + 1));
            $aux++;
        }

        return $resultado;
    }

    private function getReservapMes($mes)
    {
        $query = DB::table('tbreserva')
            ->select(DB::raw('COUNT(idReserva) AS total'))
            ->where(DB::raw('MONTH(dataReserva)'), '=', $mes)
            ->where('tbreserva.idRestaurante', '=', Session::get('idRestaurante'))
            ->where('idStatusReserva', '=', "1")
            ->first()->total;

            return $query;
    }
}
