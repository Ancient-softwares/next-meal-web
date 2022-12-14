<?php

namespace App\Http\Controllers;

use App\Models\RestauranteModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CrudTipoRestaurante extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Session::get('login');
        if($login != 'admin') {
            return redirect('index');
        }
        
        $tipos = TipoRestauranteModel::paginate(5);
        return view('admin.tipos-restaurante', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
            'tipo' => 'required'
        ]);

        TipoRestauranteModel::where('idTipoRestaurante', $id)->update([
            'tipoRestaurante' => $request->tipo
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $restaurante = RestauranteModel::where('idTipoRestaurante', $id)->update([
            'idTipoRestaurante' => 1,
        ]);

        TipoRestauranteModel::where('idTipoRestaurante', $id)->delete();
        return redirect()->back();    
    }
}
