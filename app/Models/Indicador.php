<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indicador extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'indicadores';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'proyecto',
        'objetivoEspecifico',
    ];

    // Relación: Un indicador pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto');
    }

    // Relación: Un indicador pertenece a un objetivo específico
    public function objetivoEspecifico()
    {
        return $this->belongsTo(ObjetivoEspecifico::class, 'objetivoEspecifico');
    }
}