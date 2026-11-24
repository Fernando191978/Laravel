<?php

namespace App\Http\Controllers;

use App\Models\Indicador;

class IndicadorController extends Controller
{
    public function index()
    {
        $indicadores = Indicador::all();

        return view('indicadores.index', compact('indicadores'));
    }
}