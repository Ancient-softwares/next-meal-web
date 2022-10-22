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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\TipoRestauranteFactory::new ();
    }
}