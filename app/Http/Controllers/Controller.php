<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\RestauranteModel;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $restauntes;

    public function restaurantes(Request $request) {
        $login = $request->session()->get('login');
        $id = $request->session()->get('idRestaurante');

        if(!isset($login)) {
            return false;
        }

        $restaurantes = $this->restauntes->where('idRestaurante', $id)->get();

        return response()->json([
            'idRestaurante' => $restaurantes->idRestaurante,
            'nomeRestaurante' => $restaurantes->nomeRestaurante,
            'cpfRestaurante' => $restaurantes->cpfRestaurante,
            'telRestaurante' => $restaurantes->telRestaurante,
            'fotoRestaurante' => $restaurantes->fotoRestaurante,
            'emailRestaurante' => $restaurantes->emailRestaurante,
            'cepRestaurante' => $restaurantes->cepRestaurante,
            'ruaRestaurante' => $restaurantes->ruaRestaurante,
            'numRestaurante' => $restaurantes->numRestaurante,
            'bairroRestaurante' => $restaurantes->bairroRestaurante,
            'cidadeRestaurante' => $restaurantes->cidadeRestaurante,
            'estadoRestaurante' => $restaurantes->estadoRestaurante,
            'capMaximaRestaurante' => $restaurantes->capMaximaRestaurante,
            'tipoRestaurante' => $restaurantes->tipoRestaurante,
        ]);
    }
}
