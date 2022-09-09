<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerfilPageController extends Controller
{

    private $restaurante;
    private $tipoRestaurante;

    public function __construct(Request $request)
    {
        $this->restaurante = new RestauranteModel();
        $this->tipoRestaurante = new TipoRestauranteModel();
    }

    public function index(Request $request) {
        $login = $request->session()->get('login');
        if(!isset($login)) {
            return redirect()->back();
        }

        $info = RestauranteModel::where('nomeRestaurante', $login)->first();
        $tipoRestaurante = $this->tipoRestaurante->all();

        return view('perfil-page', compact('info', 'login', 'tipoRestaurante'));
    }

    public function editarPerfil(Request $request) {
        $login = $request->session()->get('login');
        if(!isset($login)) {
            return redirect()->back();
        }

        $info = RestauranteModel::where('nomeRestaurante', $login)->first();
        $tipos = $this->tipoRestaurante->all();

        return view('editar-perfil', compact('info', 'tipos', 'login'));
    }

    public function editou(Request $request) {
        $login = $request->session()->get('login');
        if(!isset($login)) {
            return redirect()->back();
        }

        $imageName = $this->restaurante->where('nomeRestaurante', $login)->first()->fotoRestaurante;


        if($request->hasFile("fotoRestaurante") && $request->file("fotoRestaurante")->isValid()) {
            if(File::exists('img/fotosPerfil/'.$imageName)) {
                File::delete('img/fotosPerfil/'.$imageName);
            }

            $requestImage = $request->fotoRestaurante;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->fotoRestaurante->move(public_path('img/fotosPerfil'), $imageName);
        }

        $telefone = $request->telRestaurante;
        $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
        $telefone = str_replace('-', '', $telefone);

        $cep = $request->cepRestaurante;
        $cep = str_replace('-', '', $cep);

        $cadastro = $this->restaurante->where('nomeRestaurante', $login)->update([
            'nomeRestaurante' => $request->nomeRestaurante,
            'cpfRestaurante' => $request->cpfRestaurante,
            'telRestaurante' => $telefone,
            'fotoRestaurante' => $imageName,
            'emailRestaurante' => $request->emailRestaurante,
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->ruaRestaurante,
            'numRestaurante' => $request->numRestaurante,
            'bairroRestaurante' => $request->bairroRestaurante,
            'cidadeRestaurante' => $request->cidadeRestaurante,
            'estadoRestaurante' => $request->estadoRestaurante,
            'capMaximaRestaurante' => $request->capMaximaRestaurante,
            'idTipoRestaurante' => $request->tipoRestaurante
        ]);

        if($cadastro) {
            $request->session()->put('login', $request->nomeRestaurante);
            return redirect()->route('perfil-page');

        }
        else {
            dd($cadastro);
        }

    }
}
