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
        "cnpjRestaurante",
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
        "horarioAberturaRestaurante",
        "horarioFechamentoRestaurante",
        "ocupacaoRestaurante",
        "descricaoRestaurante",
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\RestauranteFactory::new();
    }
}
