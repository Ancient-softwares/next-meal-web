<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPratoModel extends Model
{
    use HasFactory;

    protected $table = "tbtipoprato";

    protected $fillable = [
        'idTipoPrato',
        'tipoPrato',

    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    protected static function newFactory()
    {
        return \Database\Factories\TipoPratoFactory::new ();
    }
}