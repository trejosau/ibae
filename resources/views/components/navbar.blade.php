<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FFB6C1;">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            data-mdb-collapse-init
            class="navbar-toggler"
            type="button"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="/home">
                <img
                    src="{{ asset('images/logo.png') }}"
                    height="64"
                    alt="IBAE"
                    loading="lazy"
                />
            </a>

            @if(!request()->is('dashboard') && !request()->is('dashboard/*'))
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link roboto-medium" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link roboto-medium" href="/contacto">Contáctanos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link roboto-medium" href="#">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="icono" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="icono" href="#"><i class="fab fa-facebook"></i></a>
                </li>
            </ul>
            @else
                <ul class="navbar-nav navbar-dark ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.inicio')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.opcion1')}}">Opcion 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.opcion2')}}">Opcion 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.opcion3')}}">Opcion 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.opcion4')}}">Opcion 4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link roboto-medium" href="{{route('dashboard.opcion5')}}">Opcion 5</a>
                    </li>
                </ul>
                @endif
        </div>

        <div class="d-flex align-items-center">
            @if(auth()->check() && !request()->routeIs('dashboard'))
                <!-- Carrito -->
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart icono"></i>
                </a>

                <!-- Notifications -->
                <div class="dropdown">
                    <a
                        data-mdb-dropdown-init
                        class="text-reset me-3 hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuLink"
                        role="button"
                        aria-expanded="false"
                    >
                        <i class="fas fa-bell icono"><span class="badge rounded-pill badge-notification bg-danger icono-chico">1</span></i>
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuLink"
                    >
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
            @endif

            <!-- Avatar -->
            <div class="dropdown">
                @if(auth()->check())
                    <a
                        data-mdb-dropdown-init
                        class="dropdown-toggle d-flex align-items-center hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuAvatar"
                        role="button"
                        aria-expanded="false"
                    >
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            class="rounded-circle"
                            height="64"
                            alt="{{ auth()->user()->username }}"
                            loading="lazy"
                        />
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuAvatar"
                    >
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary login-button me-3">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
