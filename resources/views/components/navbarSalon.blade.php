<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-salon.jpg') }}" alt="Logo"
                style="width: auto; height: 110px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Instalaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Estilistas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Referencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Agenda</a>
                    </li>
                </ul>
                <div class="dropdown ms-3" style="display: flex; align-items: center;">
                    @if(auth()->check())
                        <a href="#" id="navbarDropdownMenuAvatar" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a></li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Cerrar sesión</button>
                                </form>
                            </li>
                            <li><a class="dropdown-item" href="/pedidos">Mis Citas</a></li>
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="btn nav-icons">Iniciar sesión</a>
                    @endif
                </div>
            </div>
    
            </div>
        </div>
    </nav>
</header>
