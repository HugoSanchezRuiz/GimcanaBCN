<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimcana extends Model
{
    protected $fillable = ['nombre_gimcana'];
    public function ubicaciones()
    {
        return $this->belongsToMany(Ubicacion::class, 'gimcana_ubicaciones', 'gimcana_id', 'ubicacion_id');
    }

    // public function ubicaciones()
    // {
    //     return $this->hasMany(GimcanaUbicacion::class);
    // }

}
