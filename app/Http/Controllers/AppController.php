<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\ReservaModel;
use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\TipoRestauranteModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDOException;

class AppController extends Controller
{
    private $reservas;
    private $restaurantes;
    private $clientes;
    private $tipoRestaurante;
    private $avaliacao;

    public function __construct()
    {
        $this->reservas = new ReservaModel();
        $this->restaurantes = new RestauranteModel();
        $this->clientes = new ClienteModel();
        $this->tipoRestaurante = new TipoRestauranteModel();
        $this->avaliacao = new AvaliacaoModel();
    }

    public function reserva(Request $request)
    {
        $dataReserva = $request->dataReserva;
        $horaReserva = $request->horaReserva;
        $numPessoas = $request->numPessoas;

        $reserva = $this->reservas->create([
            "dataReserva" => $dataReserva,
            "horaReserva" => $horaReserva,
            "numPessoas" => $numPessoas
        ]);
    }

    public function getPratosByRestaurante(Request $request)
    {
        $idRestaurante = $request->idRestaurante;

        $pratos = DB::table('tbprato')
            ->select('idPrato', 'nomePrato', 'valorPrato', 'fotoPrato', 'tipoPrato')
            ->join('tbtipoprato', 'tbprato.idTipoPrato', '=', 'tbtipoprato.idTipoPrato')
            ->where('tbprato.idRestaurante', '=', $idRestaurante)
            ->get();

        return response()->json($pratos);
    }

    public function getAvaliacoesByRestaurante(Request $request)
    {
        $idRestaurante = $request->idRestaurante;

        $avaliacoes = DB::table('tbavaliacao')
            ->select('tbavaliacao.idAvaliacao', 'tbavaliacao.notaAvaliacao', 'tbavaliacao.dtAvaliacao', 'tbavaliacao.descAvaliacao', 'tbcliente.nomeCliente')
            ->join('tbcliente', 'tbavaliacao.idCliente', '=', 'tbcliente.idCliente')
            ->where('tbavaliacao.idRestaurante', '=', $idRestaurante)
            ->get();

        return response()->json($avaliacoes);
    }

    public function getRestaurants()
    {
        $table = RestauranteModel::select(
            'tbrestaurante.idRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.telRestaurante',
            'tbrestaurante.emailRestaurante',
            'tbrestaurante.ruaRestaurante',
            'tbrestaurante.cepRestaurante',
            'tbrestaurante.ruaRestaurante',
            'tbrestaurante.bairroRestaurante',
            'tbrestaurante.cidadeRestaurante',
            'tbrestaurante.estadoRestaurante',
            'tbrestaurante.horarioAberturaRestaurante',
            'tbrestaurante.horarioFechamentoRestaurante',
            'tbrestaurante.capMaximaRestaurante',
            'tbrestaurante.ocupacaoRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.fotoRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
            'tbavaliacao.descAvaliacao',
        )
            ->join('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
            ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->get();

        // gets the average of the rating
        $table->map(function ($item) {
            $item->notaAvaliacao = DB::table('tbavaliacao')
                ->where('idRestaurante', $item->idRestaurante)
                ->avg('notaAvaliacao');
            return $item;
        });

        // deletes duplicates
        $table = $table->unique('idRestaurante');

        // converts the average rating to a float
        $table->map(function ($item) {
            $item->notaAvaliacao = (float) $item->notaAvaliacao;
            return $item;
        });

        return response()->json($table);
    }

    public function getTipoRestaurantes()
    {
        $table = $this->tipoRestaurante->select('idTipoRestaurante', 'tipoRestaurante')->get();
        return response()->json([
            'data' => $table,
            'message' => 'Tipos de restaurantes retornados com sucesso'
        ], 201);
    }

    public function cadastroCliente(Request $request)
    {
        try {
            $senha = $request->senha;
            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $telefone = $request->telefoneCliente;
            $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
            $telefone = str_replace('-', '', $telefone);

            $cpf = $request->cpfCliente;
            $cpf = preg_replace('/[^A-Za-z0-9\-]/', '', $cpf);
            $cpf = str_replace('-', '', $cpf);

            $cep = $request->cepCliente;
            $cep = str_replace('-', '', $cep);

            // $this->uploadImage($request->fotoCliente, $request->nomeCliente);

            // checks if the email already exists
            try {

                $varEmail = $this->clientes->where('emailCliente', $request->emailCliente)->first();
                if ($varEmail) {
                    return response()->json([
                        'message' => 'Email já cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Email já cadastrado'
                ], 400);
            }

            // checks if the cpf already exists
            try {
                $varCpf = $this->clientes->where('cpfCliente', $cpf)->first();
                if ($varCpf) {
                    return response()->json([
                        'message' => 'CPF já cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'CPF já cadastrado'
                ], 400);
            }

            // checks if the phone number already exists
            try {

                $varTelefone = $this->clientes->where('telefoneCliente', $telefone)->first();
                if ($varTelefone) {
                    return response()->json([
                        'message' => 'Telefone já cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Telefone já cadastrado'
                ], 400);
            }


            $cad = $this->clientes->create([
                "nomeCliente" => $request->nomeCliente,
                "cpfCliente" => $cpf,
                "telefoneCliente" => $telefone,
                "senhaCliente" => $request->senhaCliente,
                "emailCliente" => $request->emailCliente,
                "fotoCliente" => $request->fotoCliente || '../../../public/img/sem-foto.png',
                "cepCliente" => $cep,
                "ruaCliente" => $request->ruaCliente,
                "numCasa" => $request->numCasa,
                "bairroCliente" => $request->bairroCliente,
                "cidadeCliente" => $request->cidadeCliente,
                "estadoCliente" => $request->estadoCliente
            ]);

            if ($cad) {
                return response()->json([
                    'status' => 201,
                    'message' => 'Cadastro realizado com sucesso!'
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Erro ao cadastrar cliente',
                    'status' => 500,
                    'request' => $request->all()
                ], 500);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function uploadImage(Request $request)
    {
        try {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $validated = $request->validated();

            if ($validated) {
                $imageName = time() . '.' . $request->image->extension();

                $request->image->move(public_path('img'), $imageName);

                $upload = $this->clientes->imageCliente = $imageName;

                return response()->json([
                    'message' => 'Imagem enviada com sucesso',
                    'status' => 200,
                    'image' => $imageName
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Erro ao enviar imagem',
                    'status' => 500,
                    'request' => $request->all()
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getToken(Request $request)
    {
        try {
            $cliente = $this->clientes->where('emailCliente', '=', $request->emailCliente)->first();
            return $cliente->token;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function loginCliente(Request $request)
    {
        $cliente = $this->clientes->where('emailCliente', '=', $request->emailCliente)->first();
        $senha = $request->senhaCliente;

        if (!$cliente) {
            return response([
                'status' => 401,
                'message' => 'Login ou senha incorretos!',
                'data' => error_get_last(),
            ]);
        }

        if ($senha != $cliente->senhaCliente) {
            return response([
                'status' => 401,
                'message' => 'Login ou senha incorretos!',
                'data' => error_get_last(),
            ]);
        }

        $token = Str::random(200);

        $cliente->token = $token;
        $this->clientes->where('emailCliente', '=', $request->emailCliente)->update([
            'token' => $token
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Login realizado com sucesso!',
            'data' => $cliente,
            'token' => $token,
        ]);
    }

    public function getRestaurantByCep(Request $request)
    {
        try {

            $cep = $request->cepRestaurante;
            $cep = str_replace('-', '', $cep);

            $restaurante = $this->restaurantes->where('cepRestaurante', '=', $cep)->get();

            if ($restaurante) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Restaurante encontrado!',
                    'data' => $restaurante,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Restaurante não encontrado!',
                    'data' => error_get_last(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar restaurante',
                'message' => $e->getMessage(),
                'request' => $request->all()
            ], 500);
        }
    }

    // gets all restaurants by type
    public function getRestaurantsByType(Request $request)
    {
        try {
            $tipoRestaurante = $this->tipoRestaurante->where('tipoRestaurante', '=', $request->tipoRestaurante)->first();

            // removes duplicate restaurants
            $restaurantes = RestauranteModel::select(
                'tbrestaurante.idRestaurante',
                'tbrestaurante.nomeRestaurante',
                'tbrestaurante.telRestaurante',
                'tbrestaurante.emailRestaurante',
                'tbrestaurante.ruaRestaurante',
                'tbrestaurante.cepRestaurante',
                'tbrestaurante.ruaRestaurante',
                'tbrestaurante.bairroRestaurante',
                'tbrestaurante.cidadeRestaurante',
                'tbrestaurante.estadoRestaurante',
                'tbrestaurante.horarioAberturaRestaurante',
                'tbrestaurante.horarioFechamentoRestaurante',
                'tbrestaurante.capMaximaRestaurante',
                'tbrestaurante.ocupacaoRestaurante',
                'tbrestaurante.nomeRestaurante',
                'tbrestaurante.fotoRestaurante',
                'tbrestaurante.descricaoRestaurante',
                'tbtiporestaurante.tipoRestaurante',
                'tbavaliacao.notaAvaliacao',
                'tbavaliacao.descAvaliacao',
            )
                ->join('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
                ->where('tbtiporestaurante.tipoRestaurante', '=', $request->tipoRestaurante)
                ->get();


            // removes empty restaurants
            $restaurantes = $restaurantes->filter(function ($value, $key) {
                return $value != null;
            });

            // gets the average of the rating
            $restaurantes->map(function ($item) {
                $item->notaAvaliacao = DB::table('tbavaliacao')
                    ->where('idRestaurante', $item->idRestaurante)
                    ->avg('notaAvaliacao');
                return $item;
            });

            // deletes duplicates
            $restaurantes = $restaurantes->unique('idRestaurante');

            // converts the average rating to a float
            $restaurantes->map(function ($item) {
                $item->notaAvaliacao = (float) $item->notaAvaliacao;
                return $item;
            });

            if ($restaurantes) {
                return $restaurantes;
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Restaurantes não encontrados!',
                    'data' => error_get_last(),
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // gets all restaurants by name
    public function getRestaurantsByName(Request $request)
    {
        try {
            $name = $request->name;

            $restaurantes = $this->restaurantes->where('nomeRestaurante', 'like', '%' . $name . '%')->get();

            return response()->json([
                'message' => 'Restaurantes encontrados com o nome ' . $name,
                'data' => $restaurantes
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }

    // passwrod reset
    public function resetPassword(Request $request)
    {
        try {
            $email = $request->email;
            $senha = $request->senha;

            $cliente = $this->clientes->where('emailCliente', '=', $email)->first();

            if ($cliente) {
                $this->clientes->where('emailCliente', '=', $email)->update([
                    'senhaCliente' => $senha
                ]);

                return response()->json([
                    'message' => 'Senha alterada com sucesso!',
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Email não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // update user data
    public function updateUserData(Request $request)
    {
        try {
            $email = $request->emailCliente;
            $nome = $request->nomeCliente;
            $celular = $request->telefoneCliente;
            $cpf = $request->cpfCliente;
            $cep = $request->cepCliente;
            $rua = $request->ruaCliente;
            $numero = $request->numeroCliente;
            $bairro = $request->bairroCliente;
            $cidade = $request->cidadeCliente;
            $estado = $request->estadoCliente;

            $cliente = $this->clientes->where('emailCliente', '=', $email)->first();

            if ($cliente) {
                $this->clientes->where('emailCliente', '=', $email)->update([
                    'nomeCliente' => $nome,
                    'celCliente' => $celular,
                    'cpfCliente' => $cpf,
                    'cepCliente' => $cep,
                    'ruaCliente' => $rua,
                    'numCasa' => $numero,
                    'bairroCliente' => $bairro,
                    'cidadeCliente' => $cidade,
                    'estadoCliente' => $estado
                ]);

                return response()->json([
                    'message' => 'Dados atualizados com sucesso!',
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Email não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // update user by id
    public function updateUserById(Request $request)
    {
        try {
            $id = $request->idCliente;
            $nome = $request->nomeCliente;
            $celular = $request->telefoneCliente;
            $cpf = $request->cpfCliente;
            $cep = $request->cepCliente;
            $rua = $request->ruaCliente;
            $numero = $request->numeroCliente;
            $bairro = $request->bairroCliente;
            $cidade = $request->cidadeCliente;
            $estado = $request->estadoCliente;

            $cliente = $this->clientes->where('idCliente', '=', $id)->first();

            if ($cliente) {
                $this->clientes->where('idCliente', '=', $id)->update([
                    'nomeCliente' => $nome,
                    'telefoneCliente' => $celular,
                    'cpfCliente' => $cpf,
                    'cepCliente' => $cep,
                    'ruaCliente' => $rua,
                    'numCasa' => $numero,
                    'bairroCliente' => $bairro,
                    'cidadeCliente' => $cidade,
                    'estadoCliente' => $estado
                ]);

                return response()->json([
                    'message' => 'Dados atualizados com sucesso!',
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Email não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // get user data
    public function getUserData(Request $request)
    {
        try {
            $email = $request->email;

            $cliente = $this->clientes->where('emailCliente', '=', $email)->first();

            if ($cliente) {
                return response()->json([
                    'message' => 'Dados do usuário ' . $email,
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Email não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // get user data by id
    public function getUserDataById(Request $request)
    {
        try {
            $id = $request->id;

            $cliente = $this->clientes->where('idCliente', '=', $id)->first();

            if ($cliente) {
                return response()->json([
                    'message' => 'Dados do usuário ' . $id,
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Id não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // delete user by id
    public function deleteUserById(Request $request)
    {
        try {
            $id = $request->id;

            $cliente = $this->clientes->where('idCliente', '=', $id)->first();

            if ($cliente) {
                $this->clientes->where('idCliente', '=', $id)->delete();

                return response()->json([
                    'message' => 'Usuário deletado com sucesso!',
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Id não encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // gets the restaurants with the most reservations
    public function getRestaurantesMaisReservados(Request $request)
    {
        try {
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', DB::raw('count(tbreserva.idRestaurante) as total'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->groupBy('tbrestaurante.nomeRestaurante', 'tbreserva.idRestaurante')
                ->orderBy('total', 'desc')
                ->limit($request->limite)
                ->get();


            return response()->json([
                'message' => 'Restaurantes encontrados com sucesso!',
                'data' => $query,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar restaurantes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets the restaurants with the best ratings  
    public function getRestaurantesMelhoresAvaliados(Request $request)
    {
        try {
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', 'tbavaliacao.notaAvaliacao', DB::raw('avg(tbavaliacao.notaAvaliacao) as media'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->groupBy('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', 'tbavaliacao.notaAvaliacao')
                ->orderBy('media', 'desc')
                ->limit($request->limite)
                ->get();

            // converts the average rating to a float
            $query->map(function ($item) {
                $item->media = (float) $item->media;
                return $item;
            });

            return response()->json([
                'message' => 'Restaurantes encontrados com sucesso!',
                'data' => $query,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar restaurantes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // gets the restaurants with the most reservations and best ratings
    public function getRestaurantesMaisReservadosMelhoresAvaliados(Request $request)
    {
        try {
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', 'tbavaliacao.notaAvaliacao', DB::raw('count(tbreserva.idRestaurante) as total, avg(tbavaliacao.notaAvaliacao) as media'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->groupBy('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', 'tbavaliacao.notaAvaliacao')
                ->orderBy('total', 'desc')
                ->orderBy('media', 'desc')
                ->limit($request->limite)
                ->get();

            // converts the average rating to a float
            $query->map(function ($item) {
                $item->media = (float) $item->media;
                return $item;
            });

            return response()->json([
                'message' => 'Restaurantes encontrados com sucesso!',
                'data' => $query,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar restaurantes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function postAvaliacao(Request $request)
    {
        try {
            $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();

            if ($cliente) {
                $query = $this->avaliacao->create([
                    'idRestaurante' => $request->idRestaurante,
                    'idCliente' => $request->idCliente,
                    'notaAvaliacao' => $request->notaAvaliacao,
                    'dtAvaliacao' => date('Y-m-d H:i:s'),
                    'descAvaliacao' => $request->descAvaliacao
                ]);

                return response()->json([
                    'message' => 'Avaliação criada com sucesso!',
                    'data' => $query
                ]);
            } else {
                return response()->json([
                    'message' => 'Você precisa estar logado para avaliar o restaurante!',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar avaliação',
                'error' => $e->getMessage(),
                'data' => $request->all(),
                'cliente' => $cliente,
                'restaurante' => $this->restaurantes->where('idRestaurante', '=', $request->idRestaurante)->first()
            ], 500);
        }
    }
}
