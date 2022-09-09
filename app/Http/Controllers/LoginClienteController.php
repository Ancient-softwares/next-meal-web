<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginClienteController extends Controller
{
    public function registrar(Request $request)
    {
        $senha = $request->senha;
        $senha = password_hash($senha, PASSWORD_DEFAULT);
   
        $telefone = $request->telefone;
        $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
        $telefone = str_replace('-', '', $telefone);
        
        $cep = $request->cep;
        $cep = str_replace('-', '', $cep);

        $cad = $this->restaurantes->create([
            "nomeRestaurante" => $request->nome,
            "telRestaurante" => $telefone, 
            "cepRestaurante" => $cep,
            "senhaRestaurante" => $senha
        ]);

        if($cad) {
            return redirect()->back();
        }
    }
}
