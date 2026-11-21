<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'proyectos';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'programa',
        'titulo',
        'objetivoGeneral',
        'indicadorOG',
        'recursos',
        'responsable',
        'recursosHumanos',
        'impacto',
        'observaciones',
    ];

    // Relación muchos a muchos con Usuarios (tabla usuario_x_proyecto)
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_x_proyecto', 'proyecto', 'usuario');
    }

    // Relación uno a muchos: Un proyecto tiene muchas actividades
    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'proyecto');
    }

    // Relación uno a muchos: Un proyecto tiene muchos objetivos específicos
    public function objetivosEspecificos()
    {
        return $this->hasMany(ObjetivoEspecifico::class, 'proyecto');
    }

    // Relación uno a muchos: Un proyecto tiene muchos indicadores
    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'proyecto');
    }

    // Relación uno a muchos: Un proyecto tiene muchos grados de avance
    public function gradosAvance()
    {
        return $this->hasMany(Avance::class, 'proyecto');
    }

    // Relación uno a muchos: Un proyecto tiene muchos informes de avance
    public function informesAvance()
    {
        return $this->hasMany(Informe::class, 'proyecto');
    }
}