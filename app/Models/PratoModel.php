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
        'ingredientesPrato',
        'fotoPrato',
        'idTipoPrato',
        'idRestaurante'
    ];
}
