<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lobbies extends Model
{
    protected $fillable = ['usuario_id', 'gimcana_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function gimcana()
    {
        return $this->belongsTo(Gimcana::class);
    }

    // Más relaciones y métodos según sea necesario
}
