<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusReservaModel extends Model
{
    use HasFactory;

    protected $table = "tbstatusreserva";

    protected $fillable = [
        'idStatusReserva',
        'nomeStatusReserva'
    ];
}
