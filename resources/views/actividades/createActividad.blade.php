@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>Cargar Nueva Actividad</h2>
               <h3>Proyecto: {{ $proyecto->titulo }}</h3>
               <br>
               <button type="button" class="btn btn-primary"><a style="color: white;" href="{{ route('actividades.index', $proyecto->id) }}">Volver a la lista</a></button>
            </div>
         </div>
         <div class="col-md-10 offset-md-1">
            <form action="{{ route('actividades.store', $proyecto->id) }}" method="POST" class="main_form">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <label class="label">Nombre de la Actividad (*)</label>
                     <input type="text" class="form-control" name="nombre" required>
                  </div>
                  <div class="col-md-12">
                     <label class="label">Objetivo Específico (*)</label>
                     <select class="form-control" name="objetivoEspecifico" required>
                        <option value="">Seleccione un objetivo...</option>
                        @foreach($objetivos as $obj)
                           <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12">
                     <label class="label">Tipo (*)</label>
                     <select class="form-control" name="tipo" required>
                        <option value="Termino fijo">Término fijo</option>
                        <option value="Continua">Continua</option>
                        <option value="periódico">Periódico</option>
                     </select>
                  </div>
                  <div class="col-md-12">
                     <label class="label">Descripción (Opcional)</label>
                     <textarea class="form-control" name="descripcion" rows="3"></textarea>
                  </div>
                  
                  <!-- Aquí podrías agregar los campos de inicio, fin, frecuencia, etc., si los necesitas -->
                  
                  <div class="col-md-12">
                     <button type="submit" class="send_btn">Guardar Actividad</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection