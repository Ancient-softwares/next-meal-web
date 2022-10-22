<?php

namespace App\Http\Controllers;

use App\Models\MesaModel;
use App\Models\RestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CrudMesa extends Controller
{
    

    private $mesas;

    public function __construct()
    {
        $this->mesas = new MesaModel();
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
            return redirect()->back();
        }

        $mesas = $this->mesas->where('idRestaurante', $id)->get();

        return view("mesas", compact('mesas', 'login'));
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
            return redirect()->back();
        }

        return view("creates.create-mesa", compact('login'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurante = RestauranteModel::where("nomeRestaurante", Session::get('login'))->first();
    
        $numeracao = $this->mesas->where([["numMesa", "=", $request->numMesa], ["idRestaurante", "=", $restaurante->idRestaurante]])->first();

        $validated = $request->validate([
            'quantAcentosMesa' => 'required',
            'statusMesa' => 'required',
            'numMesa' => 'required',
        ]);

        if(isset($numeracao)) {
            return redirect()->back()->withErrors("Mesa com numeração já cadastrada!");
        }


        $cadastro = $this->mesas->create([
            'quantAcentosMesa' => $request->quantAcentosMesa,
            'statusMesa' => $request->statusMesa,
            'numMesa' => $request->numMesa,
            'idRestaurante' => $restaurante->idRestaurante,
        ]);

        if($cadastro) {
            return redirect()->route('mesas.index')->with(["success" => True]);
        }
        return redirect()->back()->withErrors('Falha ao cadastrar!');
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
            return redirect()->back();
        }

        $mesa = $this->mesas->where('idMesa', $id)->first();


        return view('creates.create-mesa', compact('login', 'mesa'));
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
        $validated = $request->validate([
            'quantAcentosMesa' => 'required',
            'statusMesa' => 'required',
        ]);

        $cadastro = $this->mesas->where('idMesa', $id)->update([
            'quantAcentosMesa' => $request->quantAcentosMesa,
            'statusMesa' => $request->statusMesa,
        ]);

        if($cadastro) {
            return redirect()->route('mesas.index')->with(["success" => True]);

        }
        return redirect()->back()->withErrors('Falha no cadastro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MesaModel::where('idMesa', $id)->delete();
        return redirect()->route('mesas.index');
    }
}
