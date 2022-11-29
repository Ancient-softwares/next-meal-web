<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RestauranteModel;
use App\Models\AvaliacaoModel;
use Illuminate\Support\Facades\Session;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $restaurante;
    private $avaliacao;

    public function __construct()
    {
        $this->restaurante = new RestauranteModel();
        $this->avaliacao = new AvaliacaoModel();
    }

    public function index()
    {
        $login = Session::get('login');
        if(!isset($login)) {
            return redirect()->route('login');
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $info = RestauranteModel::where('emailRestaurante', $login)->first();

        $avaliacoes = DB::table('tbavaliacao')
            ->select('tbavaliacao.idAvaliacao', 'tbavaliacao.notaAvaliacao', 'tbavaliacao.idCliente', 'tbavaliacao.dtAvaliacao', 'tbavaliacao.descAvaliacao', 'tbcliente.nomeCliente')
            ->join('tbcliente', 'tbavaliacao.idCliente', '=', 'tbcliente.idCliente')
            ->where('tbavaliacao.idRestaurante', '=', $info->idRestaurante)
            ->get();

        $media = DB::table('tbavaliacao')
        ->select('tbavaliacao.notaAvaliacao')
        ->where('tbavaliacao.idRestaurante', '=', $info->idRestaurante)
         ->avg('notaAvaliacao');

         $media = (float) $media;

            return view('avaliacao', compact('info', 'login', 'avaliacoes', 'media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
