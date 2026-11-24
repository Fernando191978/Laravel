@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>{{ $proyecto->titulo }}</h2>
               <h3><br><strong>Carga de avance por Actividades</strong></h3><br>
               <button type="button" class="btn btn-primary"><a style="color: white;" href="{{ route('simep.main') }}">Volver al proyecto</a></button>
               <button type="button" class="btn btn-primary"><a style="color: white;" href="{{ route('avances.index', $proyecto->id) }}">Ver avances cargados</a></button>
            </div>
         </div>
         <div class="col-md-10 offset-md-1">
            <form id="request" class="main_form" action="{{ route('avances.store', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <label class="label">Seleccione una actividad (*)</label>
                     <select class="form-control" name="actividad" required>
                        @foreach($actividades as $actividad)
                            <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                        @endforeach
                     </select>

                     <label class="label">Estado de la Actividad (*)</label>
                     <select class="form-control" name="estado" id="estado" required>
                        <option value="En ejecución">En ejecución</option>
                        <option value="Finalizada">Finalizada</option>
                        <option value="Continua">Continua</option>
                        <option value="No realizada">No realizada</option>
                     </select>

                     <label class="label">Observaciones (opcional)</label>
                     <textarea class="login" placeholder="Puede agregar más información..." name="obs"></textarea>
                     
                     <div id="campoJustificacion" style="display: none;">
                        <label class="label">Justificación (obligatoria para "No realizada")</label>
                        <textarea class="login" name="justificacion"></textarea>
                     </div>

                     <label class="label">Fuente de verificación (Archivo jpg, pdf, zip o rar) (*)</label>
                     <input type="file" class="form-control" name="fuenteV" required>
                  </div>
                  <div class="col-md-12">
                     <label class="label label-danger">(*) Datos requeridos</label>
                  </div>
                  <div class="col-md-12">
                     <button class="send_btn">Informar</button><br><br>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

{{-- Script para mostrar el campo de justificación solo si se selecciona "No realizada" --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const estado = document.getElementById('estado');
        const campoJustificacion = document.getElementById('campoJustificacion');
        
        estado.addEventListener('change', function() {
            if (this.value === 'No realizada') {
                campoJustificacion.style.display = 'block';
            } else {
                campoJustificacion.style.display = 'none';
            }
        });
    });
</script>
@endpush