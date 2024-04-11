<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';

     protected $fillable = ['nombre', 'calle', 'num_calle', 'codigo_postal', 'ciudad', 'Pista', 'contador_likes', 'tipo_ubicacion_id', 'latitud', 'longitud'];

    public function tipoUbicacion()
    {
        return $this->belongsTo(TipoUbicacion::class, 'tipo_ubicacion_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function gimcanaUbicaciones()
    {
        return $this->hasMany(GimcanaUbicacion::class);
    }
    public function gimcanas()
    {
        return $this->belongsToMany(Gimcana::class, 'gimcana_ubicaciones', 'ubicacion_id', 'gimcana_id');
    }
}
