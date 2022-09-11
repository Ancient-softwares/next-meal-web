<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservaModel;

class ReservaController extends Controller
{
    private $reservas;

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
}
