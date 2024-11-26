<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postes extends Model
{
    use HasFactory;

    // Nombre de la tabla (en caso de que no sea plural)
    protected $table = 'datos_postes'; // Nombre de la tabla en la base de datos

    // Los campos que son asignables masivamente
    protected $fillable = [
        'NameCamera',
        'location',
        'Brand',
        'Model',
        'IP',
        'Gateway',
    ];
}
