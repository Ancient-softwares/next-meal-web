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

            $param = $request;
            $param['idCliente'] = $cliente->idCliente;
            $param['idRestaurante'] = $restaurante->idRestaurante;
            $param['horaReserva'] = $horaReserva;
            $param['dataReserva'] = $dataReserva;
            $param['bearerToken'] = $request->bearerToken();

            $checking = $this->checkReserva(
                $param['idCliente'],
                $param['idRestaurante'],
                $param['dataReserva'],
                $param['horaReserva'],
                $param['numPessoas'],
                $param['bearerToken']
            );

            if ($checking->original['status'] == 200 || $checking->original['message'] == 'Reserva disponível') {
                $statusReserva = StatusReservaModel::where('statusReserva', '=', 'Aguardando')->first();

                $reserva = $this->reservas->create([
                    'dataReserva' => $request->dataReserva,
                    'horaReserva' => $request->horaReserva,
                    'idCliente' => $request->idCliente,
                    'idRestaurante' => $request->idRestaurante,
                    'idStatusReserva' => $statusReserva->idStatusReserva,
                    'numPessoas' => $request->numPessoas,
                ]);

                $reserva->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Reserva realizada com sucesso',
                    'data' => $reserva
                ], 200);
            } else {
                return response()->json([
                    'message' => $checking->original['message'],
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar reserva',
                'error' => $e->getMessage(),
                'request' => $request->all(),
                'checking' => $checking->original['message'],
            ], 500);
        }
    }

    /**
     *  check if the restaurant is open, the date is available and the number of people is available
     *
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkReserva(
        int $idCliente,
        int $idRestaurante,
        string $dataReserva,
        string $horaReserva,
        int $numPessoas,
        string $bearerToken
    ): JsonResponse {
        try {
            $cliente = $this->clientes->where('idCliente', '=', $idCliente)->first();
            $restaurante = RestauranteModel::where('idRestaurante', '=', $idRestaurante)->first();

            if ($bearerToken != $cliente->token) {
                return response()->json([
                    'message' => 'Você não está logado',
                ], 401);
            } else {

                // check if the restaurant is open
                $horaAbertura = strtotime($restaurante->horarioAberturaRestaurante);
                $horaFechamento = strtotime($restaurante->horarioFechamentoRestaurante);
                $horaReserva = strtotime($horaReserva);

                if ($horaReserva < $horaAbertura || $horaReserva > $horaFechamento) {
                    return response()->json([
                        'message' => 'O restaurante está fechado nesse horário',
                        'status' => 400,
                        'restaurante' => $restaurante,
                    ], 400);
                } else {
                    // checks if the date is available
                    $reserva = $this->reservas->where('idRestaurante', '=', $idRestaurante)
                        ->where('dataReserva', '=', $dataReserva)
                        ->where('horaReserva', '=', date('H:i:s', $horaReserva))
                        ->first();

                    if ($reserva) {
                        return response()->json([
                            'message' => 'Data e hora indisponíveis',
                            'status' => 400,
                        ]);
                    } else {
                        if (($restaurante->capacidadeRestaurante - $restaurante->ocupacaoRestaurante) >= $numPessoas) {
                            return response()->json([
                                'message' => 'Reserva disponível',
                                'status' => 200,
                            ]);
                        } else {
                            return response()->json([
                                'message' => 'Número de pessoas indisponível',
                                'status' => 400,
                            ]);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar reserva',
                'error' => $e->getMessage(),
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
            $reserva = $this->reservas->where('idReserva', '=', $id)->first();

            $validator = $request->validate([
                'idStatusReserva' => 'required|integer|exists:tbstatusreserva,idStatusReserva',
                'dataReserva' => 'required|date|date_format:Y-m-d',
                'horaReserva' => 'required|date_format:H:i:s',
                'numPessoas' => 'required|integer|min:1',
                'idCliente' => 'required|integer|exists:tbcliente,idCliente',
                'idRestaurante' => 'required|integer|exists:tbrestaurante,idRestaurante',
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

    // delete reserva
    public function deleteReserva($id): JsonResponse
    {
        try {
            $reserva = $this->reservas->where('idReserva', '=', $id)->first();

            $reserva->delete();

            return response()->json([
                'message' => 'Reserva deletada com sucesso!',
                'data' => $reserva,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar reserva',
                'error' => $e->getMessage(),
                'data' => $id,
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar reserva',
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
    public function getLatestReservasCliente($id)
    {
        try {
            $historico = $this->reservas->where('idCliente', '=', $id)->orderBy('dataReserva', 'desc')->limit(3)->get();

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
