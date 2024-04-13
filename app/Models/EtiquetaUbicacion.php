<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetaUbicacion extends Model
{
    use HasFactory;

    protected $table = 'etiquetas_ubicaciones';

    protected $fillable = [
        'nombre',
        'etiqueta_id',
        'ubicacion_id',
    ];

    // Define las relaciones con las tablas etiquetas y ubicaciones
    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class, 'etiqueta_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
}
