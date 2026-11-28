@extends('layouts.app')

@section('content')

<main class="guarantee" style="padding-top: 150px; padding-bottom: 80px;">

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>
                        Sistema de
                        <span class="blue_light">Monitoreo y Evaluación Permanente</span>
                    </h2>

                    <p>
                        Herramienta de monitoreo de la Planificación Estratégica
                        Participativa de la Facultad de Ciencias Agropecuarias
                        de la Universidad Nacional de Córdoba
                    </p>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="guarantee-box_main">
                    <div class="guarantee-box text_align_center">
                        <img
                            class="imagen-azul"
                            src="{{ asset('images/programas.png') }}"
                            alt="Programas"
                        >
                        <h3>Programas</h3>
                        <p>8 programas</p>
                    </div>
                    <a class="read_more" href="#">Ver más</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="guarantee-box_main">
                    <div class="guarantee-box text_align_center">
                        <img
                            class="imagen-azul"
                            src="{{ asset('images/proyectos.png') }}"
                            alt="Proyectos"
                        >
                        <h3>Proyectos</h3>
                        <p>59 Proyectos</p>
                    </div>
                    <a class="read_more" href="{{ route('simep.main') }}">Ver más</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="guarantee-box_main">
                    <div class="guarantee-box text_align_center">
                        <img
                            class="imagen-azul"
                            src="{{ asset('images/actividades.png') }}"
                            alt="Actividades"
                        >
                        <h3>Actividades</h3>
                        <p>673 actividades planificadas</p>
                    </div>
                    <a class="read_more" href="{{ route('simep.main') }}">
                        Ver actividades
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="guarantee-box_main">
                    <div class="guarantee-box text_align_center">
                        <img
                            class="imagen-azul"
                            src="{{ asset('images/participantes.png') }}"
                            alt="Participantes"
                        >
                        <h3>Participantes</h3>
                        <p>+600 Participantes</p>
                    </div>
                    <a class="read_more" href="#">Ver más</a>
                </div>
            </div>

        </div>

        <div class="titlepage text_align_center">
    <h2>
        SOBRE EL <span class="blue_light">SIMEP</span>
    </h2>
</div>

            <img
                src="{{ asset('images/pep.webp') }}"
                alt="Ilustración sobre el SIMEP"
                class="imagen-simep"
            >
        </section>

    </div>

</main>

@endsection