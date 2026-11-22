<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $usuario = $request->user();

        abort_unless($usuario instanceof Usuario, 403);

        $proyectos = Proyecto::query()
            ->whereHas('usuarios', function ($consulta) use ($usuario) {
                $consulta->where('usuarios.id', $usuario->getKey());
            })
            ->orderBy('proyectos.id')
            ->get(['proyectos.id', 'proyectos.titulo']);

        return view('main', [
            'nombreCompleto' => $usuario->nombre . ', ' . $usuario->apellido,
            'proyectos' => $proyectos,
        ]);
    }
}