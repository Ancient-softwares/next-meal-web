<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestauranteModel extends Model
{
    use HasFactory;

    protected $table = 'tbrestaurante';

    protected $fillable = [
        "idRestaurante",
        "nomeRestaurante",
        "cpfRestaurante",
        "telRestaurante",
        "loginRestaurante",
        "senhaRestaurante",
        "fotoRestaurante",
        "emailRestaurante",
        "cepRestaurante",
        "ruaRestaurante",
        "numRestaurante",
        "bairroRestaurante",
        "cidadeRestaurante",
        "estadoRestaurante",
        "capMaximaRestaurante",
        "idTipoRestaurante",
        "idPrato"
    ];
}
