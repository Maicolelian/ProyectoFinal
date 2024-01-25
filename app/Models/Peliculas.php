<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    use HasFactory;

    protected $table = "pelis";

    protected $fillable = [
        'nombre',
        'lanzamiento',
        'lenguaje',
        'titulo_original',
        'resumen',
        'poster'
    ];
}
