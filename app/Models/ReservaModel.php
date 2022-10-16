<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaModel extends Model
{
    use HasFactory;

    protected $table = 'tbreserva';

    protected $fillable = [
        'idReserva',
        'dataReserva',
        'horaReserva',
        'numPessoas',
        'idCliente',
        'idRestaurante',
        'idStatusReserva',
        'idAvaliação',    
    ];
}
