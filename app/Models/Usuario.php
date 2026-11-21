<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 1. Cambiamos Model por Authenticatable
use Illuminate\Notifications\Notifiable; // 2. Agregamos Notifiable
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usuario extends Authenticatable // 3. Hereda de Authenticatable
{
    use HasFactory, Notifiable;

    // Le decimos a Laravel el nombre exacto de la tabla
    protected $table = 'usuarios';

    // Los campos que se pueden llenar masivamente (para el create/update)
    protected $fillable = [
        'username',
        'password',
        'nombre',
        'apellido',
        'email',
        'tipo',
        'descripcion',
    ];

    // Ocultamos la contraseña cuando convirtamos el modelo a JSON (por seguridad)
    protected $hidden = [
        'password',
        // 'remember_token', // Lo dejamos comentado por si luego quieres usar la opción "Recordarme"
    ];

    // Relación muchos a muchos con Proyectos (tabla usuario_x_proyecto)
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'usuario_x_proyecto', 'usuario', 'proyecto');
    }
}