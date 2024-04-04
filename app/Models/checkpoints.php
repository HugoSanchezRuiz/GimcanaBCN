<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoints extends Model
{
    protected $fillable = ['usuario_id', 'gimcana_ubicaciones_id'];

    // Relación con el usuario que completó el checkpoint
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la ubicación de la gimcana
    public function gimcanaUbicacion()
    {
        return $this->belongsTo(GimcanaUbicacion::class);
    }
}