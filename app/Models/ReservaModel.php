<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaModel extends Model
{
    use HasFactory;

    protected $table = 'tbreservas';

    protected $fillable = [
        'idReservas',
        'dataReservas',
        'horaReservas',
        'numPessoas',
        'idCliente',
        'idRestaurante',
        'idStatusReserva',
        'idAvaliação',    
    ]
}
