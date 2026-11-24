<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Actividad;
use App\Models\ObjetivoEspecifico;

class ActividadController extends Controller
{
    // Listar las actividades de un proyecto
    public function index($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        // Traemos las actividades ordenadas por objetivo
        $actividades = Actividad::where('proyecto', $idProyecto)->get();
        $objetivos = ObjetivoEspecifico::where('proyecto', $idProyecto)->get();

        return view('actividades.listaActividades', compact('proyecto', 'actividades', 'objetivos'));
    }

    // Mostrar el formulario de carga (equivale a cargaActividadSimple.php)
    public function create($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        $objetivos = ObjetivoEspecifico::where('proyecto', $idProyecto)->get();

        return view('actividades.createActividad', compact('proyecto', 'objetivos'));
    }

    // Guardar la actividad en la base de datos
    public function store(Request $request, $idProyecto)
    {
        $request->validate([
            'nombre' => 'required',
            'objetivoEspecifico' => 'required',
            'tipo' => 'required',
            // Puedes agregar más validaciones si son necesarias
        ]);

        Actividad::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion ?? '',
            'inicio' => $request->inicio ?? '',
            'inicio_t' => $request->inicio_t ?? '',
            'fin' => $request->fin ?? '',
            'fin_t' => $request->fin_t ?? '',
            'inicio2' => $request->inicio2 ?? '',
            'inicio_t2' => $request->inicio_t2 ?? '',
            'fin2' => $request->fin2 ?? '',
            'fin_t2' => $request->fin_t2 ?? '',
            'tipo' => $request->tipo,
            'frecuencia' => $request->frecuencia ?? '',
            'fechaRealizacion' => $request->fechaRealizacion ?? '',
            'proyecto' => $idProyecto,
            'objetivoEspecifico' => $request->objetivoEspecifico,
        ]);

        return redirect()->route('actividades.index', $idProyecto)
                         ->with('success', 'Actividad creada exitosamente.');
    }
}