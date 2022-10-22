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
        'dataReservas',
        'horaReservas',
        'numPessoas',
        'idCliente',
        'idRestaurante',
        'idStatusReserva',
        'idAvaiacao',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\ReservaFactory::new ();
    }
}