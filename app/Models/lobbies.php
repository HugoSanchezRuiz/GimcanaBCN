<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lobbies extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_lobby', 'gimcana_id', 'lobbies_codigo', 'estado'];

    // Relación con los usuarios a través de la tabla intermedia lobbies_user
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'lobbies_user', 'lobby_id', 'usuario_id');
    }

    // Relación con la gimcana
    public function gimcana()
    {
        return $this->belongsTo(Gimcana::class);
    }

    // Relación con los jugadores en el lobby
    public function players()
    {
        return $this->hasMany(Player::class); // Asumiendo que tienes un modelo Player para representar a los jugadores
    }
}
