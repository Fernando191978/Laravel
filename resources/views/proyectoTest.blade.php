@extends('layouts.app')

@section('content')
<div class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>{{ $proyecto->titulo }}</h2>
                </div>
            </div>

            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <a class="btn btn-primary" href="{{ route('simep.main') }}">
                        Volver a Proyectos
                    </a>

                    <a class="btn btn-primary"
                        href="{{ route('actividades.index', ['id' => $proyecto->id]) }}">
                        Ver todas las actividades
                    </a>

                    <!-- BOTÓN CORREGIDO: Usa la ruta de Laravel para crear avance -->
                    <a class="btn btn-primary"
                       href="{{ route('avances.create', $proyecto->id) }}">
                        Carga de Avances
                    </a>

                    <!-- BOTÓN CORREGIDO: Usa la ruta de Laravel para listar avances -->
                    <!-- Como ya no usamos el tipo de usuario para separar vistas, usamos la misma para todos -->
                    <a class="btn btn-primary"
                       href="{{ route('avances.index', $proyecto->id) }}">
                        Ver Avances cargados
                    </a>

                    <a class="btn btn-primary"
                       href="{{ route('simep.informes', ['id' => $proyecto->id]) }}">
                        Ver Informes de Avance
                    </a>
                </div>
            </div>

            <div class="col-md-10 offset-md-1">
                <div class="main_form">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="label">Objetivo General</label>
                            <p><strong>{{ $proyecto->objetivoGeneral }}</strong></p>
                        </div>

                        <div class="col-md-12">
                            <label class="label">Objetivos Específicos</label>
                            <ul type="square">
                                @foreach ($objetivos as $objetivo)
                                    <li>{{ $objetivo->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <label class="label">Indicadores</label>
                            <ul type="square">
                                @foreach ($indicadores as $indicador)
                                    <li>{{ $indicador->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <label class="label">Actividades</label>

                            @foreach ($actividadesPorObjetivo as $grupo)
                                <h4>{{ $grupo['objetivo']->nombre }}</h4>
                                <ol>
                                    @foreach ($grupo['actividades'] as $actividad)
                                        <li>
                                            <strong>{{ $actividad->nombre }}</strong>
                                            [Tipo: {{ $actividad->tipo }}]

                                            @if ($actividad->estado === 'Finalizada')
                                                <p style="color: darkgreen;">
                                                    Estado: {{ $actividad->estado }}
                                                </p>
                                            @elseif ($actividad->estado === '')
                                                <p style="color: red;">
                                                    Estado: No informado
                                                    <!-- ENLACE CORREGIDO -->
                                                    <a class="send_btn2"
                                                       href="{{ route('avances.create', ['id' => $proyecto->id, 'act' => $actividad->id]) }}">
                                                        Cargar avance
                                                    </a>
                                                </p>
                                            @else
                                                <p style="color: blue;">
                                                    Estado: {{ $actividad->estado }}
                                                    <!-- ENLACE CORREGIDO -->
                                                    <a class="send_btn2"
                                                       href="{{ route('avances.create', ['id' => $proyecto->id, 'act' => $actividad->id]) }}">
                                                        Cargar avance
                                                    </a>
                                                </p>
                                            @endif

                                            Desde: {{ $actividad->desde }}
                                            Hasta: {{ $actividad->hasta }}
                                        </li>
                                    @endforeach
                                </ol>
                            @endforeach
                        </div>

                        <div class="col-md-12">
                            <label class="label">Recursos Humanos</label>
                            <p>{{ $proyecto->recursosHumanos }}</p>
                        </div>

                        <div class="col-md-12">
                            <label class="label">Responsable</label>
                            <p>{{ $proyecto->responsable }}</p>
                        </div>

                        <div class="col-md-12">
                            <label class="label">Impacto</label>
                            <p>{{ $proyecto->impacto }}</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection