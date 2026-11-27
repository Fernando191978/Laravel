@extends('layouts.app')

@section('content')
<main class="guarantee">
    <div class="container">
        <div class="titlepage text_align_center">
            <h2>
                Bienvenido
                <span class="blue_light">{{ $nombreCompleto }}</span>
            </h2>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Salir</button>
            </form>

            <p>Eres responsable de los siguientes proyectos</p>
        </div>

        <div class="row">
            @forelse ($proyectos as $proyecto)
                <div class="col-lg-3 col-md-6">
                    <div class="guarantee-box_main">
                        <div class="guarantee-box text_align_center">
                            <img
                                src="{{ asset('images/proyectos.png') }}"
                                width="150"
                                alt="Proyectos"
                                class="imagen-azul"
                            >
                            <h3>{{ $proyecto->titulo }}</h3>
                        </div>

                        <a
                            class="read_more"
                            href="{{ route('simep.proyecto', ['id' => $proyecto->id]) }}"
                        >
                            Ver más
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-12 text-center">No tenés proyectos asignados.</p>
            @endforelse
        </div>
    </div>
</main>
@endsection