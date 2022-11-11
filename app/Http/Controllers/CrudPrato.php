<?php

namespace App\Http\Controllers;

use App\Models\PratoModel;
use App\Models\TipoPratoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CrudPrato extends Controller
{

    private $pratos;

    public function __construct()
    {
        $this->pratos = new PratoModel();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Session::get('login');
        $id = Session::get('idRestaurante');

        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $tipos = TipoPratoModel::all();

        $pratos = $this->pratos->where('idRestaurante', $id)->get();
        
        return view('cardapio', compact('pratos', 'tipos', 'login'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }


        $tipos = TipoPratoModel::all();

        return view('creates.create-prato', compact('tipos', 'login'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $login = Session::get('login');
        $idRestaurante = Session::get('idRestaurante');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $validated = $request->validate([
            'nomePrato' => 'required',
            'valorPrato' => 'required',
            'ingredientesPrato' => 'required',
            'fotoPrato' => 'required',
            'tipoPrato' => 'required',
        ]);

        $imageName = "";

        if($request->hasFile("fotoPrato") && $request->file("fotoPrato")->isValid()) {

            $requestImage = $request->fotoPrato;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->fotoPrato->move(public_path('img/pratos'), $imageName);
        }


        $cadastro = $this->pratos->create([
            'nomePrato' => $request->nomePrato,
            'valorPrato' => $request->valorPrato,
            'ingredientesPrato' => $request->ingredientesPrato,
            'fotoPrato' => $imageName,
            'idRestaurante' => $idRestaurante,
            'idTipoPrato' => $request->tipoPrato
        ]);

        if($cadastro) {
            return redirect()->route('cardapio.index')->with('sucesso', 'Prato cadastrado');
        }

        return redirect()->route('cardapio.index')->withErrors('Não foi possível cadastrar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $tipos = TipoPratoModel::all();
        $prato = $this->pratos->where('idPrato', $id)->first();

        return view('creates.create-prato', compact('tipos', 'prato', 'login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $validated = $request->validate([
            'nomePrato' => 'required',
            'valorPrato' => 'required',
            'ingredientesPrato' => 'required',
            'tipoPrato' => 'required',
        ]);


        $imageName = $this->pratos->where(['idPrato'=>$id])->first()->fotoPrato;

        if($request->hasFile("fotoPrato") && $request->file("fotoPrato")->isValid()) {
            if(File::exists('img/pratos/'.$imageName)) {
                File::delete('img/pratos/'.$imageName);
            }     

            $requestImage = $request->fotoPrato;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->fotoPrato->move(public_path('img/pratos'), $imageName);
        }

        $cadastro = $this->pratos->where(['idPrato'=>$id])->update([
            'nomePrato' => $request->nomePrato,
            'valorPrato' => $request->valorPrato,
            'ingredientesPrato' => $request->ingredientesPrato,
            'fotoPrato' => $imageName,
            'idTipoPrato' => $request->tipoPrato
        ]);

        if($cadastro) {
            return redirect()->route('cardapio.index')->with('sucesso', 'Prato cadastrado');
        }

        return redirect()->route('cardapio.index')->withErrors('Não foi possível cadastrar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imageName = $this->pratos->where(['idPrato'=>$id])->first()->fotoPrato;

        if(File::exists('img/pratos/'.$imageName)) {
            File::delete('img/pratos/'.$imageName);
        }    

        PratoModel::where('idPrato', $id)->delete();
        return redirect()->back();
    }
}
