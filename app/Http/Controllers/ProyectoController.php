<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function mostrar(Request $request)
    {
        $datos = $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $id = $datos['id'];

        $proyecto = DB::table('proyectos')
            ->where('id', $id)
            ->first();

        abort_if(!$proyecto, 404);

        $objetivos = DB::table('objetivos_especificos')
            ->where('proyecto', $id)
            ->get(['id', 'nombre']);

        $indicadores = DB::table('indicadores')
            ->where('proyecto', $id)
            ->get(['nombre']);

        $actividadesPorObjetivo = $objetivos->map(function ($objetivo) {
            $actividades = DB::table('actividades')
                ->where('objetivoEspecifico', $objetivo->id)
                ->get(['id', 'nombre', 'inicio2', 'fin2', 'tipo']);

            foreach ($actividades as $actividad) {
                $actividad->estado = DB::table('grados_avance')
                    ->where('actividad', $actividad->id)
                    ->orderByDesc('id')
                    ->value('estado') ?? '';

                $actividad->desde = $this->formatearTrimestre($actividad->inicio2);
                $actividad->hasta = $this->formatearTrimestre($actividad->fin2);
            }

            return [
                'objetivo' => $objetivo,
                'actividades' => $actividades,
            ];
        });

        $tipoUsuario = auth()->user()->tipo ?? null;

        return view('proyectoTest', compact(
            'proyecto',
            'objetivos',
            'indicadores',
            'actividadesPorObjetivo',
            'tipoUsuario'
        ));
    }

    public function mostrarInformes(Request $request)
    {
        $datos = $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $id = $datos['id'];

        $proyecto = DB::table('proyectos')
            ->where('id', $id)
            ->first();

        abort_if(!$proyecto, 404);

        $informe = DB::table('informe_avance')
            ->where('id', $id)
            ->value('informe') ?? '';

        return view('informesCargados', compact('proyecto', 'informe'));
    }

    private function formatearTrimestre($periodo): string
    {
        if ($periodo === null || $periodo === '') {
            return '';
        }

        $periodo = (int) $periodo;
        $trimestre = intdiv($periodo, 100);
        $anio = $periodo % 100;

        return $trimestre . 'º trimestre de 20' . $anio;
    }
}