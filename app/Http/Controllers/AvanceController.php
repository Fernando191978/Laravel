<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Avance;
use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;

class AvanceController extends Controller
{
    // 1. Listar avances de un proyecto (avancesCargados.php)
    public function index($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        // Usamos la relación definida en el modelo (o consultamos directo)
        $avances = Avance::where('proyecto', $idProyecto)->orderBy('fecha', 'desc')->get();

        return view('avances.listaavance', compact('proyecto', 'avances'));
    }

    // 2. Mostrar formulario de carga (avanceCarga.php)
    public function create($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        // Traemos las actividades del proyecto para el select
        $actividades = Actividad::where('proyecto', $idProyecto)->get();

        return view('avances.createavance', compact('proyecto', 'actividades'));
    }

    // 3. Guardar el avance (el action del formulario)
    public function store(Request $request, $idProyecto)
    {
        // Validación básica
        $request->validate([
            'actividad' => 'required',
            'estado' => 'required',
            'fuenteV' => 'required|file|mimes:jpg,png,pdf,zip,rar|max:10240', // Máx 10MB
        ]);

        // Manejo del archivo (fuente de validación)
        $archivoNombre = null;
        if ($request->hasFile('fuenteV')) {
            $archivo = $request->file('fuenteV');
            $archivoNombre = time() . '_' . $archivo->getClientOriginalName();
            // Guardamos en storage/app/public/fuenteValidacion
            $archivo->storeAs('public/fuenteValidacion', $archivoNombre);
        }

        // Creamos el avance
        Avance::create([
            'proyecto' => $idProyecto,
            'actividad' => $request->actividad,
            'fecha' => now(), // Fecha actual
            'fuenteValidacion' => $archivoNombre,
            'estado' => $request->estado,
            'observaciones' => $request->obs,
            'justificacion' => $request->justificacion ?? '',
            'usuario' => Auth::id(),
            'inicio' => null,
            'fin' => null,
            'activo' => 1,
        ]);

        return redirect()->route('avances.index', $idProyecto)
                         ->with('success', 'Avance cargado exitosamente.');
    }

    // 4. Eliminar avance (avanceEliminar.php)
    public function destroy($idAvance)
    {
        $avance = Avance::findOrFail($idAvance);
        $idProyecto = $avance->proyecto;
        
        // Usamos el método desactivar() que creamos en el modelo
        $avance->desactivar();

        return redirect()->route('avances.index', $idProyecto)
                         ->with('success', 'Avance eliminado con éxito.');
    }
}