<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\ReservaModel;
use App\Models\RestauranteModel;
use App\Models\ClienteModel;
use App\Models\PratoModel;
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
            ->select('idPrato', 'nomePrato', 'valorPrato', 'ingredientesPrato', 'fotoPrato', 'fotoPrato', 'tipoPrato')
            ->join('tbtipoprato', 'tbprato.idTipoPrato', '=', 'tbtipoprato.idTipoPrato')
            ->where('tbprato.idRestaurante', '=', $idRestaurante)
            ->get();

        return response()->json($pratos);
    }

    public function getAvaliacoesByRestaurante(Request $request)
    {
        $idRestaurante = $request->idRestaurante;

        $avaliacoes = DB::table('tbavaliacao')
            ->select('tbavaliacao.idAvaliacao', 'tbavaliacao.notaAvaliacao', 'tbavaliacao.idCliente', 'tbavaliacao.dtAvaliacao', 'tbavaliacao.descAvaliacao', 'tbcliente.nomeCliente')
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
            'tbrestaurante.capacidadeRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.fotoRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
            'tbavaliacao.descAvaliacao',
        )
            ->leftJoin('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
            ->leftJoin('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
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

            // rounds the average to 1 decimal place
            $item->notaAvaliacao = round($item->notaAvaliacao, 1);
            return $item;
        });

        return response()->json($table);
    }

    public function getRestaurantById(Request $request)
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
            'tbrestaurante.capacidadeRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.fotoRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
            'tbavaliacao.descAvaliacao',
        )
            ->leftJoin('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
            ->leftJoin('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->where('tbrestaurante.idRestaurante', '=', $request->idRestaurante)
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

            // rounds the average to 1 decimal place
            $item->notaAvaliacao = round($item->notaAvaliacao, 1);
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
                        'message' => 'Email j?? cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Email j?? cadastrado'
                ], 400);
            }

            // checks if the cpf already exists
            try {
                $varCpf = $this->clientes->where('cpfCliente', $cpf)->first();
                if ($varCpf) {
                    return response()->json([
                        'message' => 'CPF j?? cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'CPF j?? cadastrado'
                ], 400);
            }

            // checks if the phone number already exists
            try {

                $varTelefone = $this->clientes->where('telefoneCliente', $telefone)->first();
                if ($varTelefone) {
                    return response()->json([
                        'message' => 'Telefone j?? cadastrado'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Telefone j?? cadastrado'
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
            // return $request->all();

            $file = $request->file('fotoCliente');

            if ($file) {
                $imageName = time() . '.' . $file->extension();

                $file->move(public_path('img/fotosCliente'), $imageName);

                $upload = $this->clientes->imageCliente = $imageName;

                if ($upload) {
                    return response()->json([
                        'status' => 201,
                        'message' => 'Imagem enviada com sucesso!'
                    ], 200);
                } else {
                    return response()->json([
                        'error' => 'N??o foi poss??vel enviar a imagem',
                        'status' => 500,
                        'request' => $request->all(),
                    ], 500);
                }
            } else {
                return response()->json([
                    'message' => 'Erro ao enviar imagem',
                    'status' => 500,
                    'request' => $request->all(),
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function decodandomeuovo(Request $request)
    {
        try {
            // return $request->all();

            $file = $request->image;

            if ($file) {

                $image_64 = $file; //your base64 encoded data

                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

                // find substring fro replace here eg: data:image/png;base64,

                $image = str_replace($replace, '', $image_64);

                $image = str_replace(' ', '+', $image);

                $imageName = Str::random(10) . '.' . $extension;

                $image->move(public_path('img/fotosCliente'), $imageName);

                // DECODAR O BANG NO APP FI

                if ($image) {
                    return response()->json([
                        'status' => 201,
                        'message' => 'Imagem enviada com sucesso!'
                    ], 200);
                } else {
                    return response()->json([
                        'error' => 'N??o foi poss??vel enviar a imagem',
                        'status' => 500,
                        'request' => $request->all()
                    ], 500);
                }
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
                    'message' => 'Restaurante n??o encontrado!',
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
                'tbrestaurante.capacidadeRestaurante',
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
                    'message' => 'Restaurantes n??o encontrados!',
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
            $name = $request->nomeRestaurante;

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
                    'message' => 'Email n??o encontrado!',
                    'data' => $cliente
                ]);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    // update user data
    public function updateCliente(Request $request)
    {
        try {
            $email = $request->emailCliente;
            $nome = $request->nomeCliente;
            $telefone = $request->telefoneCliente;
            $telefone = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone);
            $telefone = str_replace('-', '', $telefone);

            $cep = $request->cepCliente;
            $cep = str_replace('-', '', $cep);

            $cpf = $request->cpfCliente;
            $cpf = str_replace('-', '', $cpf);
            $cpf = str_replace('.', '', $cpf);
            $cpf = str_replace('/', '', $cpf);

            $rua = $request->ruaCliente;
            $numero = $request->numCasa;
            $bairro = $request->bairroCliente;
            $cidade = $request->cidadeCliente;
            $estado = $request->estadoCliente;

            $bearerToken = $request->bearerToken();

            $cliente = $this->clientes->where('token', '=', $bearerToken)->first();

            if ($cliente) {
                $this->clientes->where('token', '=', $bearerToken)->update([
                    'nomeCliente' => $nome,
                    'telefoneCliente' => $telefone,
                    'emailCliente' => $email,
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
                    'message' => 'Email n??o encontrado!',
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
                    'message' => 'Email n??o encontrado!',
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
                    'message' => 'Dados do usu??rio ' . $email,
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Email n??o encontrado!',
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
            $id = $request->idCliente;

            $cliente = $this->clientes->where('idCliente', '=', $id)->first();

            if ($cliente) {
                return response()->json([
                    'message' => 'Dados do usu??rio ' . $id,
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Id n??o encontrado!',
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
                    'message' => 'Usu??rio deletado com sucesso!',
                    'data' => $cliente
                ]);
            } else {
                return response()->json([
                    'message' => 'Id n??o encontrado!',
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
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', DB::raw('count(tbreserva.idRestaurante) as total, avg(tbavaliacao.notaAvaliacao) as media'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
                ->groupBy('tbrestaurante.nomeRestaurante', 'tbreserva.idRestaurante')
                ->orderBy('total', 'desc')
                ->limit($request->limite)
                ->get();

            // converts the average rating to a float
            $query->map(function ($item) {
                $item->media = (float) $item->media;
                // rounds the average rating to 1 decimal place
                $item->media = round($item->media, 1);
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

    // gets the restaurants with the best ratings  
    public function getRestaurantesMelhoresAvaliados(Request $request)
    {
        try {
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', DB::raw('count(tbavaliacao.idRestaurante) as notas, avg(tbavaliacao.notaAvaliacao) as media'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->groupBy('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante')
                ->orderBy('media', 'desc')
                ->limit($request->limite)
                ->get();

            // converts the average rating to a float
            $query->map(function ($item) {
                $item->media = (float) $item->media;
                // rounds the average rating to 1 decimal place
                $item->media = round($item->media, 1);
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
            $query = $this->reservas->select('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante', DB::raw('count(tbreserva.idRestaurante) as total, avg(tbavaliacao.notaAvaliacao) as media'))
                ->join('tbrestaurante', 'tbrestaurante.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->join('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbreserva.idRestaurante')
                ->groupBy('tbreserva.idRestaurante', 'tbrestaurante.nomeRestaurante')
                ->orderBy('total', 'desc')
                ->orderBy('media', 'desc')
                ->limit($request->limite)
                ->get();

            // converts the average rating to a float
            $query->map(function ($item) {
                $item->media = (float) $item->media;
                // rounds the average rating to 1 decimal place
                $item->media = round($item->media, 1);
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
                $query = $this->avaliacao->where('idCliente', '=', $request->idCliente)->where('idRestaurante', '=', $request->idRestaurante)->first();

                if ($query) {
                    return response()->json([
                        'message' => 'Voc?? j?? avaliou esse restaurante!',
                        'data' => $query,
                    ], 500);
                } else {
                    $reservation = $this->reservas
                        ->where('idCliente', '=', $request->idCliente)
                        ->where('idRestaurante', '=', $request->idRestaurante)
                        ->where('idStatusReserva', '=', 4)
                        ->first();

                    if ($reservation) {
                        $notaAvaliacao = $request->notaAvaliacao;
                        $descAvaliacao = $request->descAvaliacao;

                        if (!$notaAvaliacao && !$descAvaliacao) {
                            return response()->json([
                                'message' => 'Preencha todos os campos!',
                            ], 201);
                        } else if ($notaAvaliacao > 5) {
                            $notaAvaliacao = 5;
                        } else if ($notaAvaliacao < 1) {
                            $notaAvaliacao = 1;
                        }


                        $query = $this->avaliacao->create([
                            'idRestaurante' => $request->idRestaurante,
                            'idCliente' => $request->idCliente,
                            'notaAvaliacao' => $notaAvaliacao,
                            'dtAvaliacao' => date('Y-m-d H:i:s'),
                            'descAvaliacao' => $descAvaliacao

                        ]);

                        return response()->json([
                            'message' => 'Avalia????o criada com sucesso!',
                            'data' => $query,
                        ], 201);
                    } else {
                        return response()->json([
                            'message' => 'Voc?? n??o pode avaliar esse restaurante!',
                        ], 500);
                    }
                }
            } else {
                return response()->json([
                    'message' => 'Voc?? precisa estar logado para avaliar o restaurante!',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar avalia????o',
                'error' => $e->getMessage(),
                'data' => $request->all(),
                'cliente' => $cliente,
                'restaurante' => $this->restaurantes->where('idRestaurante', '=', $request->idRestaurante)->first()
            ], 500);
        }
    }

    public function findIfClientHasRatingByRestaurant(Request $request)
    {
        try {
            $query = $this->avaliacao->where('idCliente', '=', $request->idCliente)->where('idRestaurante', '=', $request->idRestaurante)->first();
            $idCliente = (int) $request->idCliente;
            $idRestaurante = (int) $request->idRestaurante;

            if ($query) {

                foreach ($query as $avaliacao) {
                    if ($avaliacao->idCliente == $idCliente && $avaliacao->idRestaurante == $idRestaurante) {
                        return response()->json([
                            'message' => 'Voc?? j?? avaliou esse restaurante!',
                            'data' => $avaliacao,
                        ], 201);
                    }
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar avalia????o',
                'error' => $e->getMessage(),
                'data' => $request->all(),
            ], 500);
        }
    }

    public function filterByMealsOrIngredients(Request $request)
    {
        $input = strtolower($request->input);

        $input = trim($input);

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
            'tbrestaurante.capacidadeRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
            'tbavaliacao.descAvaliacao',
        )
            ->leftJoin('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
            ->leftJoin('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->leftJoin('tbprato', 'tbprato.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->leftJoin('tbtipoprato', 'tbtipoprato.idTipoPrato', '=', 'tbprato.idTipoPrato')
            ->where(trim(strtolower('tbprato.nomePrato')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbprato.ingredientesPrato')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbrestaurante.nomeRestaurante')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbtiporestaurante.tipoRestaurante')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbtipoprato.tipoPrato')), 'LIKE', '%' . $input . '%')
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

        if (gettype($table) == 'object') {
            foreach ($table as $key) {
                unset($table->$key);
            }
        }


        return response()->json($table);
    }

    public function filterByMealsOrIngredientsByCategory(Request $request)
    {
        $input = strtolower($request->input);

        $input = trim($input);

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
            'tbrestaurante.capacidadeRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
            'tbavaliacao.descAvaliacao',
        )
            ->leftJoin('tbtiporestaurante', 'tbtiporestaurante.idTipoRestaurante', '=', 'tbrestaurante.idTipoRestaurante')
            ->leftJoin('tbavaliacao', 'tbavaliacao.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->leftJoin('tbprato', 'tbprato.idRestaurante', '=', 'tbrestaurante.idRestaurante')
            ->leftJoin('tbtipoprato', 'tbtipoprato.idTipoPrato', '=', 'tbprato.idTipoPrato')
            ->where(trim(strtolower('tbprato.nomePrato')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbprato.ingredientesPrato')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbrestaurante.nomeRestaurante')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbtiporestaurante.tipoRestaurante')), 'LIKE', '%' . $input . '%')
            ->orWhere(trim(strtolower('tbtipoprato.tipoPrato')), 'LIKE', '%' . $input . '%')
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

        if (gettype($table) == 'object') {
            foreach ($table as $key) {
                unset($table->$key);
            }
        }

        // deletes the restaurants that do not have the category
        $table = $table->filter(function ($item) use ($request) {
            return $item->tipoRestaurante == $request->tipoRestaurante;
        });


        return response()->json($table);
    }

    public function checkRatingPermission(Request $request)
    {
        $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();

        if ($cliente) {
            $query = $this->avaliacao->where('idRestaurante', '=', $request->idRestaurante)
                ->where('idCliente', '=', $request->idCliente)
                ->first();

            if ($query) {
                return response()->json([
                    'message' => 'Voc?? j?? avaliou esse restaurante!',
                    'status' => false
                ]);
            } else {
                $statusPermitido = 4;

                if ($this->reservas->where('idRestaurante', '=', $request->idRestaurante)
                    ->where('idCliente', '=', $request->idCliente)
                    ->where('idStatusReserva', '=', $statusPermitido)
                    ->first()
                ) {
                    return response()->json([
                        'message' => 'Voc?? pode avaliar esse restaurante!',
                        'status' => true
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Voc?? ainda n??o pode avaliar esse restaurante!',
                        'status' => false
                    ]);
                }
            }
        } else {
            return response()->json([
                'message' => 'Voc?? precisa estar logado para avaliar o restaurante!',
                'status' => false
            ]);
        }
    }

    public function checkNotifications(Request $request)
    {
        try {

            $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();

            if ($cliente) {
                $query = $this->reservas->where('idCliente', '=', $request->idCliente)
                    ->where('idStatusReserva', '=', 1)
                    ->get();

                $idRestaurante = $this->reservas->where('idCliente', '=', $request->idCliente)
                    ->where('idStatusReserva', '=', 1)
                    ->pluck('idRestaurante');

                $restaurante = $this->restaurantes->where('idRestaurante', '=', $idRestaurante)->first();

                if ($query && $restaurante && $idRestaurante) {
                    return response()->json([
                        'message' => 'O restaurante ' . $restaurante->nomeRestaurante . ' aceitou sua reserva!',
                        'status' => true,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Voc?? n??o tem reservas pendentes!',
                        'status' => false
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Voc?? precisa estar logado para verificar suas reservas!',
                    'status' => false
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao verificar reservas!',
                'status' => false,
                'error' => $th,
            ]);
        }
    }

    // returns users profile picture
    public function getProfileBase64Picture(Request $request)
    {
        $cliente = $this->clientes->where('idCliente', '=', $request->idCliente)->first();

        // gets the image
        $image = $this->clientes->where('idCliente', '=', $request->idCliente)->pluck('fotoCliente');

        // converts the image to blob
        $image = base64_encode($image);

        // transforms the image into base64
        $fotoCliente = base64_encode($cliente->fotoCliente);

        return $fotoCliente;
    }
}
