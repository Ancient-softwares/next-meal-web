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
    private $tipoRestaurantes;

    public function __construct()
    {
        $this->restaurantes = new RestauranteModel();
        $this->tipoRestaurantes = new TipoRestauranteModel();
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

        if (!$request->tipoRestaurante) {
            $tipoRestaurante = 1;
        } else {
            $tipoRestaurante = $this->tipoRestaurantes->where('tipoRestaurante', $request->tipoRestaurante)->first()->idTipoRestaurante;
        }

        if ($request->horarioAberturaRestaurante == null) {
            $horarioAberturaRestaurante = '08:00:00';
        }

        if ($request->horarioFechamentoRestaurante == null) {
            $horarioFechamentoRestaurante = '21:00:00';
        }

        $horarioFechamentoRestaurante = strtotime($horarioFechamentoRestaurante);
        $horarioFechamentoRestaurante = date('H:i:s', $horarioFechamentoRestaurante);
        $horarioAberturaRestaurante = strtotime($horarioAberturaRestaurante);
        $horarioAberturaRestaurante = date('H:i:s', $horarioAberturaRestaurante);

        if ($request->descricaoRestaurante) {
            $descricaoRestaurante = $request->descricaoRestaurante;
        } else {
            $descricaoRestaurante = 'Esse restaurante não possui descrição';
        }

        $telefone = $request->telefone;
        $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
        $telefone = str_replace('-', '', $telefone);

        $cep = $request->cep;
        $cep = str_replace('-', '', $cep);

        $cad = $this->restaurantes->create([
            'nomeRestaurante' => $request->nome,
            'cnpjRestaurante' => $request->cnpj || '--',
            'telRestaurante' => $telefone,
            'loginRestaurante' => $request->login,
            'senhaRestaurante' => $senha,
            'fotoRestaurante' => "user.png",
            'emailRestaurante' => $request->login,
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->rua,
            'numRestaurante' => $request->numero,
            'bairroRestaurante' => $request->bairro,
            'cidadeRestaurante' => $request->cidade,
            'estadoRestaurante' => $request->uf,
            'capMaximaRestaurante' => $request->capMaximaRestaurante || 20,
            'idTipoRestaurante' => $tipoRestaurante,
            'horarioAberturaRestaurante' => $horarioAberturaRestaurante,
            'horarioFechamentoRestaurante' => $horarioFechamentoRestaurante,
            'ocupacaoRestaurante' => $request->ocupacaoRestaurante || 0,
            'descricaoRestaurante' => $descricaoRestaurante,
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
