<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimcana extends Model
{
    protected $table = 'gimcana';

    public function ubicaciones()
    {
        return $this->hasMany(GimcanaUbicacion::class);
    }
}