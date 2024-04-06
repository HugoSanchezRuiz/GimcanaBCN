<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbicacion extends Model
{

    use HasFactory;
    protected $table = 'tipo_ubicaciones';

    protected $fillable = ['nombre'];

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class);
    }

    // Más relaciones y métodos según sea necesario
}