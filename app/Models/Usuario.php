<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable; // <-- Ya no está HasApiTokens

    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nombre',
        'apellido',
        'email',
        'tipo',
        'descripcion',
    ];

    protected $hidden = [
        'password',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'usuario_x_proyecto', 'usuario', 'proyecto');
    }
}