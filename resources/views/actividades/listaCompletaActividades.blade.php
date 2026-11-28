@extends('layouts.app') <!-- O el nombre de tu layout principal -->

@section('content')
    <!-- Contenedor para evitar la superposición con el menú -->
    <div class="container" style="margin-top: 120px; margin-bottom: 50px;">
        
        <h2>Lista Completa de Actividades</h2>

        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Actividad</th>
                    <th>Objetivo Específico</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actividades as $actividad)
                    <tr>
                        <td>{{ $actividad->id }}</td>
                        <td>{{ $actividad->nombre }}</td>
                        <td>{{ $actividad->datosObjetivo ? $actividad->datosObjetivo->nombre : 'Sin objetivo' }}</td>
                        <td>{{ $actividad->tipo }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay actividades registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         <!-- Esto dibuja los botones de paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $actividades->links() }}
        </div>

    </div>
@endsection