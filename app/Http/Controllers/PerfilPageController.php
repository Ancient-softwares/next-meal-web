<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PerfilPageController extends Controller
{

    private $restaurante;
    private $tipoRestaurante;

    public function __construct(Request $request)
    {
        $this->restaurante = new RestauranteModel();
        $this->tipoRestaurante = new TipoRestauranteModel();
    }

    public function index() {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $info = RestauranteModel::where('emailRestaurante', $login)->first();
        $tipoRestaurante = $this->tipoRestaurante->all();

        return view('perfil-page', compact('info', 'login', 'tipoRestaurante'));
    }

    public function editarPerfil() {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $info = RestauranteModel::where('emailRestaurante', $login)->first();
        $tipos = $this->tipoRestaurante->all();

        return view('editar-perfil', compact('info', 'tipos', 'login'));
    }

    public function editou(Request $request) {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }
        
        $imageName = $this->restaurante->where('emailRestaurante', $login)->first()->fotoRestaurante;


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

        $cadastro = $this->restaurante->where('emailRestaurante', $login)->update([
            'nomeRestaurante' => $request->nomeRestaurante,
            'cnpjRestaurante' => $request->cnpjRestaurante,
            'telRestaurante' => $telefone,
            'fotoRestaurante' => $imageName,
            'emailRestaurante' => $login,
            'cepRestaurante' => $cep,
            'ruaRestaurante' => $request->ruaRestaurante,
            'numRestaurante' => $request->numRestaurante,
            'bairroRestaurante' => $request->bairroRestaurante,
            'cidadeRestaurante' => $request->cidadeRestaurante,
            'estadoRestaurante' => $request->estadoRestaurante,
            'capacidadeRestaurante' => $request->capacidadeRestaurante,
            'idTipoRestaurante' => $request->tipoRestaurante
        ]);

        if($cadastro) {
            return redirect()->route('perfil-page');
        }
    }

    public function atualizarDescricao(Request $request) {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $validated = $request->validate([
            'descricao' => 'required'
        ]);

        $this->restaurante->where('emailRestaurante', $login)->update([
            'descricaoRestaurante' => $request->descricao
        ]);
        

        return redirect()->back();
    }
}
