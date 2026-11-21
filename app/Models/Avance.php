<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Avance extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'grados_avance';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'proyecto',
        'actividad',
        'fecha',
        'fuenteValidacion',
        'estado',
        'observaciones',
        'justificacion',
        'usuario',
        'inicio',
        'fin',
        'activo',
    ];

    // Opcional: castear la fecha a un objeto Carbon para manejarla mejor
    protected $casts = [
        'fecha' => 'date',
        'activo' => 'boolean',
    ];

    // Relación: Un avance pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto');
    }

    // Relación: Un avance pertenece a una actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad');
    }

    // Relación: Un avance fue registrado por un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario');
    }

    // --- Global Scope para el "borrado lógico" (campo activo) ---
    // Esto hace que automáticamente todas las consultas solo traigan los registros activos.
    protected static function booted()
    {
        static::addGlobalScope('activo', function (Builder $builder) {
            $builder->where('activo', 1);
        });
    }

    // Método para "eliminar" (poner activo = 0) en lugar de borrar de la BD
    public function desactivar()
    {
        $this->activo = 0;
        return $this->save();
    }
}