<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Informe extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'informe_avance';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'proyecto',
        'informe',
        'activo',
    ];

    // Casteo del campo activo a booleano
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación: Un informe pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto');
    }

    // --- Global Scope para el "borrado lógico" (campo activo) ---
    // Al igual que en Avance, solo traerá registros con activo = 1 por defecto.
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