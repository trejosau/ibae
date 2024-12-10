<style>

body {
    margin: 0;
    background-color: #ccf3dc;
    overflow-x: hidden;
}
.btn.nav-icons {
background-color: #cd678b; /* Color de fondo */
color: white; /* Color del texto */
padding: 10px 20px; /* Espaciado alrededor del texto */
border-radius: 5px; /* Bordes redondeados */
text-decoration: none; /* Eliminar subrayado */
font-size: 16px; /* Tamaño de la fuente */
font-weight: bold; /* Negrita */
transition: background-color 0.3s, transform 0.2s; /* Transición suave */
}

.btn.nav-icons:hover {
background-color: #a75b74; /* Color de fondo al pasar el ratón */
transform: scale(1.05); /* Efecto de agrandamiento */
}

.btn.nav-icons:active {
background-color: #934e66; /* Color de fondo al hacer clic */
}

.header {
    background-color: transparent;
    position: absolute;
    width: 100%;
    max-height: 110px;
    z-index: 1000;
    transition: background-color 0.3s ease-in-out; /* Transición de color al hacer scroll */
    animation: slideDown 1s ease-out;
    margin-bottom: 110px;
}

.navbar {
    box-shadow: none;
    padding: 0;
}

.navbar-nav {
    display: flex;
    justify-content: center; /* Centrar los elementos del menú */
    flex-wrap: wrap;
    padding: 10px;
}

.nav-item {
    margin: 0 15px; /* Espacio entre los elementos */
}

.nav-link {
    color: #cd678b; /* Color del texto */
    transition: color 0.3s, border 0.3s, transform 0.3s; /* Transiciones para el color, borde y transformación */
    padding: 10px 15px; /* Espacio interior */
    border: 2px solid transparent; /* Borde transparente inicialmente */
    border-radius: 50px; /* Borde circular */
}

.nav-link:hover {
    color: #f4b3c2; /* Color del texto al pasar el mouse */
    border-color: #f4b3c2; /* Borde al pasar el mouse */
}

.icons {
    display: flex;
    align-items: center;
    margin-left: auto;
}

.icons a {
    color: #cd678b;
    margin-left: 15px;
    transition: color 0.3s, transform 0.3s;
}

.icons a:hover {
    color: #f4b3c2;
    transform: rotate(15deg) scale(1.1);
}

.logo {
    max-width: 100px; /* Ajusta el tamaño máximo según lo necesites */
    height: auto; /* Mantiene la proporción de la imagen */
    display: block; /* Se comporta como un bloque */
    animation: fadeIn 1.5s ease-in-out; /* Animación de entrada */
}

</style>
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
                        @if(request()->path() !== 'salon')
                            <a class="nav-link" href="/salon">Salon</a>
                        @endif
                    </li>
                    @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="/miscitas">Mis Citas</a>
                    </li>
                    @if( auth()->user()->hasRole('estilista'))

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('miagenda') }}">Agenda</a>
                    </li>

                    @endif
                    @endif
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
