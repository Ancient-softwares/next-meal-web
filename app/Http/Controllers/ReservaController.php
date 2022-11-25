<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\ClienteModel;
use App\Models\ReservaModel;
use Illuminate\Http\Request;
use App\Models\AvaliacaoModel;
use App\Models\RestauranteModel;
use App\Models\StatusReservaModel;
use App\Models\TipoRestauranteModel;
use Illuminate\Support\Facades\Session;

class ReservaController extends Controller
{
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

    // index
    public function index(Request $request)
    {
        $login = Session::get('login');
        $id = Session::get('idRestaurante');

        if (!isset($login)) {
            return redirect()->back();
        }
        else if($login == "admin") {
            return redirect()->back();
        }

        $reservas = $this->reservas->where('idRestaurante', $id)->get();
        $reservasAceitas = $this->reservas->where('idRestaurante', $id)
        ->where('idStatusReserva', "=", 2)
        ->get();

        $status = $this->statusReserva->all();
        $clientes = $this->clientes->all();

        return view("reserva", compact('reservas', 'clientes', 'status', 'login', 'reservasAceitas'));
    }

    // creates a new reservation
    public function reserva(Request $request)
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
                    'horarios' => [date('H:i:s', $horaAbertura), date('H:i:s', $horaFechamento), date('H:i:s', $horaReserva),  $datetime],
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

    // updates reservation's info
    public function updateReserva(Request $request)
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

    // removes reserve
    public function deleteReserva(Request $request)
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

    // get all reserves
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

        $reserva = $this->reservas->where('idReserva', '=', $request->id)->update([
            'idStatusReserva' => 1
        ]);

        if($reserva) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors("Algo deu errado...");
    }

    public function finalizarReserva(Request $request) {
        $reserva = $this->reservas->where('idReserva', '=', $request->id)->update([
            'idStatusReserva' => 4
        ]);

        if($reserva) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors("Algo deu errado...");
    }

    // rejects a reservation
    public function rejeitarReserva(Request $request)
    {

        $reserva = $this->reservas->where('idReserva', '=', $request->id)->update([
            'idStatusReserva' => 2
        ]);

        if($reserva) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors("Algo deu errado...");


        // try {
        //     $reserva = $this->reservas->where('idReserva', '=', $request->id)->update([
        //         'idStatusReserva' => 2
        //     ]);

        //     return response()->json([
        //         'message' => 'Reserva rejeitada com sucesso!',
        //         'data' => $reserva,
        //     ], 201);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => 'Erro ao rejeitar reserva',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
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
