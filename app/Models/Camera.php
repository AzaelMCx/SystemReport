<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

    // Especificamos qué campos se pueden llenar masivamente
    protected $fillable = [
        'name',       // Nombre de la cámara
        'location',   // Ubicación de la cámara
        'latitude',   // Latitud de la cámara
        'longitude',  // Longitud de la cámara
    ];

    /**
     * Relación con los Reportes.
     * Una cámara puede tener muchos reportes.
     */
    public function reports()
    {
        return $this->hasMany(Report::class); // Relación uno a muchos
    }
}
