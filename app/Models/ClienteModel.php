<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table = 'tbcliente';

    protected $fillable = [
        'idCliente',
        'nomeCliente',
        'cpfCliente',
        'telefoneCliente',
        'senhaCliente',
        'fotoCliente',
        'emailCliente',
        'cepCliente',
        'ruaCliente',
        'numCasa',
        'bairroCliente',
        'cidadeCliente',
        'estadoCliente',
        'token'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\ClienteFactory::new();
    }
}
