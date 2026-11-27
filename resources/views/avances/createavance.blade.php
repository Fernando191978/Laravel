@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>{{ $proyecto->titulo }}</h2>
               <h3><strong>Carga de avance por Actividades</strong></h3>
               <br>

               <a class="btn btn-primary" style="color: white;" href="{{ route('simep.main') }}">
                  Volver al proyecto
               </a>

               <a class="btn btn-primary" style="color: white;" href="{{ route('avances.index', $proyecto->id) }}">
                  Ver avances cargados
               </a>
            </div>
         </div>

         <div class="col-md-10 offset-md-1">
            <form
               id="request"
               class="main_form"
               action="{{ route('avances.store', $proyecto->id) }}"
               method="POST"
               enctype="multipart/form-data"
            >
               @csrf

               <div class="row">
                  <div class="col-md-12">
                     <label class="label" for="actividad">Seleccione una actividad (*)</label>
                     <select class="form-control" name="actividad" id="actividad" required>
                        @foreach($actividades as $actividad)
                           <option
                              value="{{ $actividad->id }}"
                              @selected(old('actividad') == $actividad->id)
                           >
                              {{ $actividad->nombre }}
                           </option>
                        @endforeach
                     </select>
                     @error('actividad')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror

                     <label class="label" for="inicio">Fecha de inicio (*)</label>
                     <input
                        class="form-control"
                        type="date"
                        name="inicio"
                        id="inicio"
                        value="{{ old('inicio') }}"
                        required
                     >
                     @error('inicio')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror

                     <label class="label" for="fin">Fecha de fin (*)</label>
                     <input
                        class="form-control"
                        type="date"
                        name="fin"
                        id="fin"
                        value="{{ old('fin') }}"
                        required
                     >
                     @error('fin')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror

                     <label class="label" for="estado">Estado de la Actividad (*)</label>
                     <select class="form-control" name="estado" id="estado" required>
                        <option value="En ejecución" @selected(old('estado') === 'En ejecución')>
                           En ejecución
                        </option>
                        <option value="Finalizada" @selected(old('estado') === 'Finalizada')>
                           Finalizada
                        </option>
                        <option value="Continua" @selected(old('estado') === 'Continua')>
                           Continua
                        </option>
                        <option value="No realizada" @selected(old('estado') === 'No realizada')>
                           No realizada
                        </option>
                     </select>
                     @error('estado')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror

                     <label class="label" for="obs">Observaciones (opcional)</label>
                     <textarea
                        class="login"
                        id="obs"
                        placeholder="Puede agregar más información..."
                        name="obs"
                     >{{ old('obs') }}</textarea>

                     <div
                        id="campoJustificacion"
                        style="{{ old('estado') === 'No realizada' ? 'display: block;' : 'display: none;' }}"
                     >
                        <label class="label" for="justificacion">
                           Justificación (obligatoria para “No realizada”)
                        </label>
                        <textarea class="login" id="justificacion" name="justificacion">{{ old('justificacion') }}</textarea>
                     </div>
                     @error('justificacion')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror

                     <label class="label" for="fuenteV">
                        Fuente de verificación (jpg, png, pdf, zip o rar) (*)
                     </label>
                     <input
                        type="file"
                        class="form-control"
                        name="fuenteV"
                        id="fuenteV"
                        accept=".jpg,.jpeg,.png,.pdf,.zip,.rar"
                        required
                     >
                     @error('fuenteV')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-12">
                     <label class="label label-danger">(*) Datos requeridos</label>
                  </div>

                  <div class="col-md-12">
                     <button type="submit" class="send_btn">Informar</button>
                     <br><br>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const estado = document.getElementById('estado');
        const campoJustificacion = document.getElementById('campoJustificacion');

        estado.addEventListener('change', function () {
            campoJustificacion.style.display =
                this.value === 'No realizada' ? 'block' : 'none';
        });
    });
</script>
@endpush