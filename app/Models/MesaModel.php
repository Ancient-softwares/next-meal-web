<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesaModel extends Model
{
    use HasFactory;

    protected $table = "tbmesa";

    protected $fillable = [
        "idMesa",
        "quantAcentosMesa",
        "statusMesa",
        "numMesa",
        "idRestaurante"
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\MesaFactory::new ();
    }
}