<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actividad extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'actividades';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'inicio',
        'inicio_t',
        'fin',
        'fin_t',
        'inicio2',
        'inicio_t2',
        'fin2',
        'fin_t2',
        'tipo',
        'frecuencia',
        'proyecto',
        'objetivoEspecifico',
    ];

    // Relación: Una actividad pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto');
    }

    // Relación: Una actividad pertenece a un objetivo específico
    public function objetivoEspecifico()
    {
        return $this->belongsTo(ObjetivoEspecifico::class, 'objetivoEspecifico');
    }

    // Relación: Una actividad tiene muchos grados de avance
    public function gradosAvance()
    {
        return $this->hasMany(Avance::class, 'actividad');
    }

    // --- Lógica de negocio de tu archivo viejo ---

    // Convertimos los métodos getInicioHumano() etc., en Accessors (Atributos calculados)
    // Ahora puedes llamar a $actividad->inicio_humano y Laravel lo calculará solo.
    
    public function getInicioHumanoAttribute()
    {
        if (!$this->inicio) return null;
        $trimestre = intdiv($this->inicio, 100);
        $anio = $this->inicio % 100;
        return $trimestre . "º trimestre del año 20" . $anio;
    }

    public function getFinHumanoAttribute()
    {
        if (!$this->fin) return null;
        $trimestre = intdiv($this->fin, 100);
        $anio = $this->fin % 100;
        return $trimestre . "º trimestre del año 20" . $anio;
    }

    public function getInicioHumano2Attribute()
    {
        if (!$this->inicio2) return null;
        $trimestre = intdiv($this->inicio2, 100);
        $anio = $this->inicio2 % 100;
        return $trimestre . "º trimestre de 20" . $anio;
    }

    public function getFinHumano2Attribute()
    {
        if (!$this->fin2) return null;
        $trimestre = intdiv($this->fin2, 100);
        $anio = $this->fin2 % 100;
        return $trimestre . "º trimestre de 20" . $anio;
    }
}