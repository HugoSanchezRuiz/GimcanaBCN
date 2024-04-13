<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';

    public function tipoUbicacion()
    {
        return $this->belongsTo(TipoUbicacion::class, 'tipo_ubicacion_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function etiquetaUbicaciones()
    {
        return $this->belongsToMany(EtiquetaUbicacion::class);
    }

    public function gimcanaUbicaciones()
    {
        return $this->belongsToMany(GimcanaUbicacion::class);
    }
}
