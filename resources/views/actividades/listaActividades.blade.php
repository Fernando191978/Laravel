@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>Actividades del Proyecto: {{ $proyecto->titulo }}</h2>
               <br>
               <button type="button" class="btn btn-primary">
                  <a style="color: white;" href="{{ route('simep.proyecto', ['id' => $proyecto->id]) }}">
                     Volver al Proyecto
                  </a>
               </button>
               <button type="button" class="btn btn-success">
                  <a style="color: white;" href="{{ route('actividades.create', $proyecto->id) }}">+ Nueva Actividad</a>
               </button>
            </div>
         </div>
         <div class="col-md-10 offset-md-1">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Nombre</th>
                     <th>Objetivo Específico</th>
                     <th>Tipo</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($actividades as $actividad)
                  <tr>
                     <td>{{ $actividad->id }}</td>
                     <td>{{ $actividad->nombre }}</td>
                     <td>{{ $actividad->objetivoEspecificoRelacion->nombre ?? 'N/A' }}</td> <!-- Asegúrate de tener esta relación en el modelo -->
                     <td>{{ $actividad->tipo }}</td>
                     <td>
                         <!-- Aquí podrías agregar botones para editar o eliminar -->
                         <a href="{{ route('actividades.create', ['id' => $proyecto->id]) }}"
                           class="btn btn-sm btn-info">
                           Editar
                        </a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection