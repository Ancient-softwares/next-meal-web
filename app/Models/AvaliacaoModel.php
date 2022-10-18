<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoModel extends Model
{
    use HasFactory;

    protected $table = 'tbavaliacao';

    protected $fillable = [
        'idAvaliacao',
        'dtAvaliacao',
        'notaAvaliacao',
        'descAvaliacao'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\AvaliacaoFactory::new ();
    }
}