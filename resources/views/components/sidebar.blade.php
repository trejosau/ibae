
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="bi bi-grid-1x2"></i>
                <i class="bi bi-grid-1x2-fill hidden"></i> <!-- Este icono estará oculto inicialmente -->
            </button>
            <div class="sidebar-logo">
                <p class="usuario">Hola, {{ auth()->user()->username }}</p>
                <p  id="fecha-hora"></p>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <ul class="sidebar-nav ">
            <li class="sidebar-item mb-3">
                <a href="{{ route('home') }}" class="sidebar-link ir-inicio ">
                    <i class="fa-solid fa-home"></i>
                    <span class="volver-home">Volver al inicio</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a href="{{ route('dashboard.inicio') }}" class="sidebar-link">
                    <i class='fas fa-chart-line'></i>
                    <span>Resumen general</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.ventas') }}" class="sidebar-link">
                    <i class="fa-solid fa-shop"></i>
                    <span>Ventas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.pedidos') }}" class="sidebar-link">
                    <i class="fa-solid fa-shop"></i>
                    <span>Pedidos</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.compras') }}" class="sidebar-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('dashboard.citas')}}" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#opcion4" aria-expanded="false" aria-controls="opcion4">
                    <i class="fa-solid fa-scissors"></i>
                    <span>Salon</span>
                </a>
                <ul id="opcion4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{route('dashboard.citas')}}" class="sidebar-link">Citas</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('dashboard.servicios')}}" class="sidebar-link">Servicios</a>
                    </li>

                </ul>

            </li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard.productos') }}" class="sidebar-link">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>Productos</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard.usuarios') }}" class="sidebar-link">
                    <i class="fa-regular fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.auditoria') }}" class="sidebar-link">
                    <i class='fas fa-archive'></i>
                    <span>Auditoría</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#profileDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#profileDropdown" aria-expanded="false" aria-controls="profileDropdown">
                    <i class="fa-solid fa-gear"></i>
                    <span>Mi perfil</span>
                </a>
                <ul id="profileDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">Información</a>
                    </li>v
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">Configuración</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">Notificaciones</a>
                    </li>
                </ul>
            </li>


        </ul>
        <li class="sidebar-footer">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="sidebar-link" type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>

    </aside>

