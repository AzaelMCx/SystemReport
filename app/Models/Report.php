<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_id',  // Relación con la cámara
        'description',
        'status',
        'date',
    ];

    /**
     * Relación con el modelo Camera.
     * Cada reporte pertenece a una cámara.
     */
    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    /**
     * Scope para obtener solo los reportes pendientes.
     */
    public function scopePendiente($query)
    {
        return $query->where('status', 'Pendiente');
    }

    // En el modelo Report
    public function scopeSolucionados($query)
    {

        return $query->where('status', 'solucionado');
    }

}
