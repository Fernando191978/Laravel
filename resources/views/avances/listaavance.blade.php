@extends('layouts.app')

@section('content')
<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage text_align_center">
               <h2>{{ $proyecto->titulo }}</h2>
               <br>
               <button type="button" class="btn btn-primary"><a style="color: white;" href="{{ route('simep.main') }}">Volver al proyecto</a></button>
               <button type="button" class="btn btn-primary"><a style="color: white;" href="{{ route('avances.create', $proyecto->id) }}">Carga de Avances</a></button>
            </div>
         </div>
         <div class="col-md-12">
            <label class="label">Cargas de avances realizadas (Ordenadas por fecha de carga)</label>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Fecha</th>
                     <th>Actividad</th>
                     <th>Estado</th>
                     <th>Observaciones</th>
                     <th>Fuente de Verif.</th>
                     <th>Acción</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($avances as $avance)
                  <tr>
                     <td>{{ \Carbon\Carbon::parse($avance->fecha)->format('d/m/Y') }}</td>
                     <td>{{ $avance->actividadRelacion->nombre ?? 'N/A' }}</td>
                     <td>{{ $avance->estado }}</td>
                     <td>
                         {{ $avance->observaciones }}
                         @if($avance->estado == 'No realizada')
                             <br><strong>Justificación:</strong><br> {{ $avance->justificacion }}
                         @endif
                     </td>
                     <td>
                         @if($avance->fuenteValidacion)
                             <a href="{{ asset('storage/fuenteValidacion/'.$avance->fuenteValidacion) }}">Archivo</a>
                         @else
                             -
                         @endif
                     </td>
                     <td>
                        <form action="{{ route('avances.destroy', $avance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar avance?')">
                                <img src="{{ asset('images/delete.png') }}" width="30px" title="Eliminar">
                            </button>
                        </form>
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