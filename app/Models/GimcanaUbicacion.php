<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GimcanaUbicacion extends Model
{
    protected $fillable = ['gimcana_id', 'ubicacion_id', 'orden'];

    public function gimcana()
    {
        return $this->belongsTo(Gimcana::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    // Más relaciones y métodos según sea necesario
}