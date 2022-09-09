<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRestauranteModel extends Model
{
    use HasFactory;

    protected $table = "tbtiporestaurante";

    protected $fillable = [
        'idTipoRestaurante',
        'tipoRestaurante'
    ];
}
