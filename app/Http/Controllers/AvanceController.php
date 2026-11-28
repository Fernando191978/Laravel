<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Avance;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AvanceController extends Controller
{
    // Listar los avances de un proyecto.
    public function index($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $avances = Avance::where('proyecto', $idProyecto)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('avances.listaavance', compact('proyecto', 'avances'));
    }

    // Mostrar el formulario para cargar un avance.
    public function create($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $actividades = Actividad::where('proyecto', $idProyecto)->get();

        return view('avances.createavance', compact('proyecto', 'actividades'));
    }

    // Guardar el avance.
    public function store(Request $request, $idProyecto)
    {
        $datos = $request->validate([
            'actividad' => [
                'required',
                'integer',
                Rule::exists('actividades', 'id')
                    ->where('proyecto', $idProyecto),
            ],
            'estado' => ['required', 'string'],
            'inicio' => ['required', 'date'],
            'fin' => ['required', 'date', 'after_or_equal:inicio'],
            'obs' => ['nullable', 'string'],
            'justificacion' => ['nullable', 'string'],
            'fuenteV' => [
                'required',
                'file',
                'mimes:jpg,png,pdf,zip,rar',
                'max:10240',
            ],
        ]);

        $archivo = $request->file('fuenteV');
        $archivoNombre = time() . '_' . $archivo->getClientOriginalName();

        $archivo->storeAs('public/fuenteValidacion', $archivoNombre);

        Avance::create([
            'proyecto' => $idProyecto,
            'actividad' => $datos['actividad'],
            'fecha' => now(),
            'fuenteValidacion' => $archivoNombre,
            'estado' => $datos['estado'],
            'observaciones' => $datos['obs'] ?? null,
            'justificacion' => $datos['justificacion'] ?? '',
            'usuario' => Auth::id(),
            'inicio' => $datos['inicio'],
            'fin' => $datos['fin'],
            'activo' => 1,
        ]);

        return redirect()
            ->route('avances.index', $idProyecto)
            ->with('success', 'Avance cargado exitosamente.');
    }

    // Desactivar un avance.
    public function destroy($idAvance)
    {
        $avance = Avance::findOrFail($idAvance);
        $idProyecto = $avance->proyecto;

        $avance->desactivar();

        return redirect()
            ->route('avances.index', $idProyecto)
            ->with('success', 'Avance eliminado con éxito.');
    }
}