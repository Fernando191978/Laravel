<div class="header">
    <div class="container">
        <div class="row d_flex">
            <div class="col-md-2 col-sm-3 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/simep2.png') }}" alt="Logo SIMEP">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <nav class="navigation navbar navbar-expand-md navbar-dark">
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarsExample04"
                        aria-controls="navbarsExample04"
                        aria-expanded="false"
                        aria-label="Abrir menú"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('en_construccion/index.html') }}">
                                    Documentación
                                </a>
                            </li>

                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="https://agro.unc.edu.ar/planificacion-institucional/pep-2030/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    PEP2030
                                </a>
                            </li>

                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="https://agro.unc.edu.ar"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    FCA
                                </a>
                            </li>

                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/login') }}">Ingresar</a>
                                </li>
                            @endguest

                            @auth
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link btn btn-link" type="submit">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>