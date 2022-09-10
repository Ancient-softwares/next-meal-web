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
        'celCliente',
        'senhaCliente',
        'fotoCliente',
        'emailCliente',
        'cepCliente',
        'ruaCliente',
        'numCasaCliente',
        'bairroCliente',
        'cidadeCliente',
        'estadoCliente',
    ];
}
