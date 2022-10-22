<?php

namespace App\Http\Controllers;

use App\Models\ReservaModel;
use App\Models\StatusReservaModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservadoidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Session::get('login');
        $id = Session::get('idRestaurante');

        if (!isset($login)) {
            return redirect()->route('login');
        }

        $reservas = $this->reservas->where('idRestaurante', $id)->get();

        return view("reservas", compact('reservas', 'login'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();
            $restaurante = $this->restaurantes->where('idRestaurante', '=', $request->idRestaurante)->first();

            $datetime = strtotime($request->dataReserva);
            $dataReserva = date('Y-m-d H:i', $datetime);

            $numPessoas = $request->numPessoas;

            $statusReserva = StatusReservaModel::where('statusReserva', '=', 'Aguardando')->first();

            $reserva = $this->reservas->create([
                'dataReserva' => $dataReserva,
                'numPessoas' => $numPessoas,
                'idCliente' => $cliente->idCliente,
                'idRestaurante' => $restaurante->idRestaurante,
                'idStatusReserva' => $statusReserva->idStatusReserva,
                'idAvaliacao' => null,
            ]);

            return response()->json([
                'message' => 'Reserva realizada com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar reserva',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $reserva = $this->reservas->where('idReserva', '=', $request->idReserva)->first();

            $reserva->dataReserva = $request->dataReserva || $reserva->dataReserva;
            $reserva->numPessoas = $request->numPessoas || $reserva->numPessoas;
            $reserva->idCliente = $request->idCliente || $reserva->idCliente;
            $reserva->idRestaurante = $request->idRestaurante || $reserva->idRestaurante;
            $reserva->idStatusReserva = $request->idStatusReserva || $reserva->idStatusReserva;
            $reserva->idAvaliacao = $request->idAvaliacao || $reserva->idAvaliacao;

            $reserva->save();

            return response()->json([
                'message' => 'Reserva atualizada com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $query = ReservaModel::where('idReserva', '=', $request->idReserva)->delete();

            return response()->json([
                'message' => 'Reserva deletada com sucesso!',
                'data' => $query,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar reserva',
                'error' => $e->getMessage(),
                'data' => $request,
            ], 500);
        }
    }

    public function getReservas()
    {
        try {
            $reservas = $this->reservas->all();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // get one reserve by its id
    public function getReserva(Request $request)
    {
        try {
            $reserva = $this->reservas->where('idReserva', '=', $request->idReserva)->first();

            return response()->json([
                'message' => 'Reserva encontrada com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets all reserve by restaurant id
    public function getReservasByRestaurante(Request $request)
    {
        try {
            $reservas = $this->reservas->where('idRestaurante', '=', $request->idRestaurante)->get();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets all reserve by client id
    public function getReservasByCliente(Request $request)
    {
        try {
            $reservas = $this->reservas->where('idCliente', '=', $request->idCliente)->get();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets all reserve by status id
    public function getReservasByStatus(Request $request)
    {
        try {
            $reservas = $this->reservas->where('idStatusReserva', '=', $request->idStatusReserva)->get();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets all reserve by date
    public function getReservasByData(Request $request)
    {
        try {
            $reservas = $this->reservas->where('dataReserva', '=', $request->dataReserva)->get();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // accepts a reservation
    public function aceitarReserva(Request $request)
    {
        try {
            $reserva = $this->reservas->where('idReserva', '=', $request->idReserva)->first();

            $reserva->idStatusReserva = 2;
            $reserva->save();

            return response()->json([
                'message' => 'Reserva aceita com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao aceitar reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // rejects a reservation
    public function rejeitarReserva(Request $request)
    {
        try {
            $reserva = $this->reservas->where('idReserva', '=', $request->idReserva)->first();

            $reserva->idStatusReserva = 3;
            $reserva->save();

            return response()->json([
                'message' => 'Reserva rejeitada com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao rejeitar reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets all reserve by restaurant id and status
    public function getReservasByRestauranteAndStatus(Request $request)
    {
        try {
            $reservas = $this->reservas->where('idRestaurante', '=', $request->idRestaurante)
                ->where('idStatusReserva', '=', $request->idStatusReserva)
                ->get();

            return response()->json([
                'message' => 'Reservas encontradas com sucesso!',
                'data' => $reservas,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // gets last three reservations made by client
    public function getLatestReservasCliente(Request $request)
    {
        try {
            $historico = $this->reservas->where('idCliente', '=', $request->idCliente)->orderBy('dataReserva', 'desc')->limit(3)->get();

            return response()->json([
                'message' => 'Histórico encontrado com sucesso!',
                'data' => $historico,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar histórico',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets last three reservations made by restaurant
    public function getLatestReservasRestaurante(Request $request)
    {
        try {
            $historico = $this->reservas->where('idRestaurante', '=', $request->idRestaurante)->orderBy('dataReserva', 'desc')->limit(3)->get();

            return response()->json([
                'message' => 'Histórico encontrado com sucesso!',
                'data' => $historico,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar histórico',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
