<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesaReservaModel extends Model
{
    use HasFactory;

    protected $table = 'tbmesareserva';

    protected $fillable = [
        'idMesaReserva',
        'idMesa',
        'idReserva',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\MesaReservaFactory::new ();
    }
}