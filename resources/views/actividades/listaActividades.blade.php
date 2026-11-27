@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>Actividades del Proyecto: {{ $proyecto->titulo }}</h2>
               <br>

               <a
                  class="btn btn-primary"
                  style="color: white;"
                  href="{{ route('simep.proyecto', ['id' => $proyecto->id]) }}"
               >
                  Volver al Proyecto
               </a>
            </div>
         </div>

         <div class="col-md-10 offset-md-1">
            @if(session('success'))
               <div class="alert alert-success">
                  {{ session('success') }}
               </div>
            @endif

            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Nombre</th>
                     <th>Objetivo Específico</th>
                     <th>Tipo</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach($actividades as $actividad)
                     <tr>
                        <td>{{ $actividad->id }}</td>
                        <td>{{ $actividad->nombre }}</td>
                        <td>{{ $actividad->objetivoEspecificoRelacion->nombre ?? 'N/A' }}</td>
                        <td>{{ $actividad->tipo }}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection