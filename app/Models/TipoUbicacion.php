<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbicacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_ubicaciones';

    // Protege todos los campos
    protected $guarded = [];
    // Más relaciones y métodos según sea necesario
}