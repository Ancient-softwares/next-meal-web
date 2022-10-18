<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PratoModel extends Model
{
    use HasFactory;

    protected $table = 'tbprato';

    protected $fillable = [
        'idPrato',
        'nomePrato',
        'valorPrato',
        'ingredientePrato',
        'fotoPrato',
        'idTipoPrato',
        'idRestaurante',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\PratoFactory::new ();
    }
}