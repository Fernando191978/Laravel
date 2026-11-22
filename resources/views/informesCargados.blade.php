@extends('layouts.app')

@section('content')
<div class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>{{ $proyecto->titulo }}</h2>

                    @if (session('msg'))
                        <div class="{{ session('class', 'alert alert-info') }}" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <a class="btn btn-primary"
                       href="{{ route('simep.proyecto', ['id' => $proyecto->id]) }}">
                        Volver al proyecto
                    </a>

                    <a class="btn btn-primary"
                       href="{{ url('/avanceCarga.php') }}?id={{ $proyecto->id }}">
                        Carga de Avances
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
                            <label class="label">Informe de avances de UEPEP</label>

                            {{-- Muestra el contenido HTML del informe, como hacía el PHP original. --}}
                            {!! $informe !!}

                            <p><br></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection