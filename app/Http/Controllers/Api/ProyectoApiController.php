<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use OpenApi\Attributes as OA;

class ProyectoApiController extends Controller
{
    #[OA\Get(
        path: "/api/proyectos",
        summary: "Obtener todos los proyectos",
        tags: ["Proyectos"],
        responses: [
            new OA\Response(response: 200, description: "Lista de proyectos obtenida con éxito")
        ]
    )]
    public function index()
    {
        return response()->json(Proyecto::all());
    }
}