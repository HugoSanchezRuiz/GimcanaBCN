<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'lobby_id']; // Ajusta según tus necesidades

    // Relación con la lobby
    public function lobby() {
        return $this->belongsTo(Lobbies::class);
    }
}
