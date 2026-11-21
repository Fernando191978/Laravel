<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ObjetivoEspecifico extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'objetivos_especificos';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'proyecto',
    ];

    // Relación: Un objetivo específico pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto');
    }

    // Relación: Un objetivo específico tiene muchas actividades
    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'objetivoEspecifico');
    }

    // Relación: Un objetivo específico tiene muchos indicadores
    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'objetivoEspecifico');
    }
}