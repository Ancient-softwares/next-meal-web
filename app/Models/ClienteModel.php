<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table;

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
        'numRuaCliente',
        'bairroCliente',
        'cidadeCliente',
        'estadoCliente',
    ];
}
