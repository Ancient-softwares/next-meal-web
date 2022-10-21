<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoModel;
use App\Models\ClienteModel;
use App\Models\ReservaModel;
use App\Models\RestauranteModel;
use App\Models\StatusReservaModel;
use App\Models\TipoRestauranteModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ReservadoidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $reservas;
    private $restaurantes;
    private $clientes;
    private $tipoRestaurante;
    private $avaliacao;

    private $statusReserva;


    public function __construct()
    {
        $this->reservas = new ReservaModel();
        $this->restaurantes = new RestauranteModel();
        $this->clientes = new ClienteModel();
        $this->tipoRestaurante = new TipoRestauranteModel();
        $this->avaliacao = new AvaliacaoModel();
        $this->statusReserva = new StatusReservaModel();
    }

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
    public function create(Request $request): JsonResponse
    {
        try {
            $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();
            $restaurante = RestauranteModel::where('idRestaurante', '=', $request->idRestaurante)->first();

            $datetime = strtotime($request->dataReserva);
            $time = strtotime($request->horaReserva);
            $dataReserva = date('Y-m-d', $datetime);
            $horaReserva = date('H:i:s', $time);

            // check if the restaurant is open
            $horaAbertura = strtotime($restaurante->horarioAberturaRestaurante);
            $horaFechamento = strtotime($restaurante->horarioFechamentoRestaurante);
            $horaReserva = strtotime($horaReserva);

            if ($horaReserva < $horaAbertura || $horaReserva > $horaFechamento) {
                return response()->json([
                    'message' => 'O restaurante está fechado nesse horário',
                    'status' => 400,
                    'request' => $request->all(),
                    'restaurante' => $restaurante,
                    'horarios' => [date('H:i:s', $horaAbertura), date('H:i:s', $horaFechamento), date('H:i:s', $horaReserva),  $datetime]
                ], 400);
            } else {
                // checks if the date is available
                $reserva = $this->reservas->where('idRestaurante', '=', $request->idRestaurante)
                    ->where('dataReserva', '=', $dataReserva)
                    ->where('horaReserva', '=', date('H:i:s', $horaReserva))
                    ->first();

                if ($reserva) {
                    return response()->json([
                        'message' => 'Data e hora indisponíveis',
                        'status' => 400,
                        'horarios' => [date('H:i:s', $horaAbertura), date('H:i:s', $horaFechamento), date('H:i:s', $horaReserva), $reserva, $request->all()]
                    ]);
                } else {
                    $numPessoas = $request->numPessoas;

                    $statusReserva = StatusReservaModel::where('statusReserva', '=', 'Aguardando')->first();

                    $reserva = $this->reservas->create([
                        'dataReserva' => $dataReserva,
                        'horaReserva' => date('H:i:s', $horaReserva),
                        'numPessoas' => $numPessoas,
                        'idCliente' => $cliente->idCliente,
                        'idRestaurante' => $restaurante->idRestaurante,
                        'idStatusReserva' => $statusReserva->idStatusReserva,
                    ]);

                    return response()->json([
                        'message' => 'Reserva realizada com sucesso!',
                        'data' => $reserva,
                    ], 201);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar reserva',
                'error' => $e->getMessage(),
                'request' => $request->all(),
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
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $reserva = $this->reservas->where('idReserva', '=', $request->idReserva)->first();

            $validator = $request->validate([
                'idReserva' => 'required|integer|exists:reservas,idReserva',
                'idStatusReserva' => 'required|integer|exists:status_reserva,idStatusReserva',
                'dataReserva' => 'required|date|date_format:Y-m-d',
                'horaReserva' => 'required|date_format:H:i:s',
                'numPessoas' => 'required|integer|min:1',
                'idCliente' => 'required|integer|exists:clientes,idCliente',
                'idRestaurante' => 'required|integer|exists:restaurantes,idRestaurante',
            ]);

            $validate = Validator::make($request->all(), $validator);

            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Erro ao atualizar reserva',
                    'error' => $validate->errors(),
                    'request' => $request->all(),
                ], 400);
            } else {
                $reserva->dataReserva = $request->dataReserva || $reserva->dataReserva;
                $reserva->numPessoas = $request->numPessoas || $reserva->numPessoas;
                $reserva->idCliente = $request->idCliente || $reserva->idCliente;
                $reserva->idRestaurante = $request->idRestaurante || $reserva->idRestaurante;
                $reserva->idStatusReserva = $request->idStatusReserva || $reserva->idStatusReserva;

                $reserva->save();

                return response()->json([
                    'message' => 'Reserva atualizada com sucesso!',
                    'data' => $reserva,
                ], 201);
            }
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
    public function destroy(Request $request, $id): JsonResponse
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
