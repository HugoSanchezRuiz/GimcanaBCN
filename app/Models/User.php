<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con las lobbies a través de la tabla intermedia lobbies_user
    public function lobbies()
    {
        return $this->belongsToMany(Lobbies::class, 'lobbies_user', 'usuario_id', 'lobby_id')
            ->withPivot('id'); // Especificamos que queremos seleccionar la columna 'id' de la tabla intermedia
    }

    // Más relaciones y métodos según sea necesario
}
