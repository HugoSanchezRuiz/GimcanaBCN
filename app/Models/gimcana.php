<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimcana extends Model
{
    protected $fillable = ['nombre_gimcana'];

    public function ubicaciones()
    {
        return $this->hasMany(GimcanaUbicacion::class);
    }

    // Más relaciones y métodos según sea necesario
}