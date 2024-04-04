<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbicacion extends Model
{
    protected $fillable = ['nombre'];

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class);
    }

    // Más relaciones y métodos según sea necesario
}