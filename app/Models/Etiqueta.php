<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $fillable = ['nombre'];

    // Relación muchos a muchos con Ubicacion
    public function ubicaciones()
    {
        return $this->belongsToMany(Ubicacion::class);
    }

    // Más relaciones y métodos según sea necesario
}
