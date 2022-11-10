<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel;
use App\Models\RestauranteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index() {
        $login = Session::get('login');
        if(!isset($login) && $login != 'admin') {
            return redirect('index');
        }

        return view('admin.dashboard');
    }

    public function pagrestaurantes() {
        $login = Session::get('login');
        if(!isset($login) && $login != 'admin') {
            return redirect('index');
        }

        $restaurantes = RestauranteModel::all();

        return view('admin.restaurantes', compact('restaurantes'));
    }

    public function pagclientes() {
        $login = Session::get('login');
        if(!isset($login) && $login != 'admin') {
            return redirect('index');
        }

        $clientes = ClienteModel::all();

        return view('admin.clientes', compact('clientes'));
    }
}
