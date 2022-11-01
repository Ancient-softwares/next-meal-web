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

    public function getRestaurants()
    {
        $table = RestauranteModel::select(
            'tbrestaurante.idRestaurante',
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
            'tbrestaurante.ocupacaoRestaurante',
            'tbrestaurante.nomeRestaurante',
            'tbrestaurante.fotoRestaurante',
            'tbrestaurante.descricaoRestaurante',
            'tbtiporestaurante.tipoRestaurante',
            'tbavaliacao.notaAvaliacao',
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

                $email = $this->clientes->where('emailCliente', $request->emailCliente)->first();
                if ($email) {
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

                $cpf = $this->clientes->where('cpfCliente', $cpf)->first();
                if ($cpf) {
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

                $telefone = $this->clientes->where('telefoneCliente', $telefone)->first();
                if ($telefone) {
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
                    'status' => 'success',
                    'message' => 'Cadastro realizado com sucesso!'
                ]);
            } else {
                return response()->json([
                    'error' => 'Erro ao cadastrar cliente',
                    'status' => 500,
                    'request' => $request->all()
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao cadastrar cliente',
                'message' => $e->getMessage(),
                'request' => $request->all()
            ], 500);
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
            $type = $request->type;
            $typeId = $this->tipoRestaurante->where('tipoRestaurante', '=', $type)->first();

            $restaurantes = $this->restaurantes->where('idTipoRestaurante', '=', $typeId)->get();

            return response()->json([
                'message' => 'Restaurantes encontrados do tipo ' . $type,
                'data' => $restaurantes
            ]);
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
}
