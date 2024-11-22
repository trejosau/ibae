<style>
<style>
    /* Estilos globales para <a> */
    a {
        text-decoration: none; 
        color: inherit;
    }

    /* Estilos para hover con un color melón suave */
    a:hover {
        color: #ffa07a; /* Cambia al color melón suave al pasar el cursor */
    }
</style>

</style>
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="bi bi-grid-1x2"></i>
                <i class="bi bi-grid-1x2-fill hidden"></i>
            </button>
            <div class="sidebar-logo">
                <p class="usuario">Hola, {{ auth()->user()->username }}</p>
                <p id="fecha-hora"></p>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <ul class="sidebar-nav">
            <!-- Sección para todos -->
            <li class="sidebar-item" style="text-decoration: none; color: inherit;">
                <a  style="text-decoration: none; color: inherit;" href="{{ route('home') }}" class="sidebar-link">
                    <i class="fa-solid fa-reply"></i>
                    <span>Volver a Inicio</span>
                </a>
            </li>

            @if(auth()->user()->hasAnyRole(['profesor', 'admin']))
            <!-- Código para la pestaña Cursos -->
            <li class="sidebar-item">
                <a style="text-decoration: none; color: inherit;" href="#cursosDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#cursosDropdown" aria-expanded="false" aria-controls="cursosDropdown">
                    <i class="fa-solid fa-book"></i>
                    <span style="text-decoration: none; color: inherit;">Cursos</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="cursosDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a style="text-decoration: none; color: inherit;" href="{{ route('plataforma.mis-cursos') }}" class="sidebar-link">Ver Cursos</a></li>
                    <li class="sidebar-item"><a style="text-decoration: none; color: inherit;" href="{{route('plataforma.historial-cursos')}}" class="sidebar-link">Historial de Cursos</a></li>
                </ul>
            </li>
        @endif

        @if(auth()->user()->hasAnyRole(['profesor', 'admin']))
        <!-- Sección para Módulos -->
        <li class="sidebar-item">
            <a style="text-decoration: none; color: inherit;" href="#modulosDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#modulosDropdown" aria-expanded="false" aria-controls="modulosDropdown">
                <i class="fa-solid fa-th-list"></i>
                <span >Módulos</span>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul id="modulosDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item"><a  style="text-decoration: none; color: inherit;" href="{{route('plataforma.lista-modulos')}}" class="sidebar-link">Modulos y Temas</a></li>
               </ul>
        </li>
        @endif


        @if(auth()->user()->hasAnyRole(['profesor', 'admin']))
        <!-- Sección para Estudiantes/Profesores -->
        <li class="sidebar-item">
            <a style="text-decoration: none; color: inherit;"href="#estudiantesProfesoresDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#estudiantesProfesoresDropdown" aria-expanded="false" aria-controls="estudiantesProfesoresDropdown">
                <!-- Nuevo ícono para Estudiantes/Profesores -->
                <i class="fa-solid fa-chalkboard-teacher"></i>
                <span>Personal</span>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul id="estudiantesProfesoresDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item"><a  style="text-decoration: none; color: inherit;" href="{{route('plataforma.estudiantes')}}" class="sidebar-link">Lista de Estudiantes</a></li>
                <li class="sidebar-item"><a  style="text-decoration: none; color: inherit;" href="{{route('plataforma.inscripciones')}}" class="sidebar-link">Inscripciones</a></li>
              

            </ul>
        </li>
        @endif




        @if(auth()->user()->hasAnyRole(['admin']))
        <!-- Sección de Finanzas -->
        <li class="sidebar-item">
            <a href="#finanzasDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#finanzasDropdown" aria-expanded="false" aria-controls="finanzasDropdown" style="text-decoration: none; color: inherit;">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>Finanzas</span>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul id="finanzasDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item"><a href="{{route('plataforma.historial-pagos')}}" class="sidebar-link" style="text-decoration: none; color: inherit;">Historial de Pagos</a></li>
            </ul>
        </li>
        @endif




        @if(auth()->user()->hasAnyRole(['es', 'admin']))        
        <li class="sidebar-item">
            <a href="#estudianteDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#estudianteDropdown" aria-expanded="false" aria-controls="estudianteDropdown" style="text-decoration: none; color: inherit;">
                <i class="fa-solid fa-user"></i>
                <span>Mi espacio</span>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul id="estudianteDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{route('plataforma.espacio-mis-cursos')}}" class="sidebar-link" style="text-decoration: none; color: inherit;">Mis Cursos</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('plataforma.espacio-mis-pagos')}}" class="sidebar-link" style="text-decoration: none; color: inherit;">Mis Pagos</a>
                </li>
            </ul>
        </li>
         @endif
            <!-- Sección exclusiva para Estudiantes -->
        </ul>

        <!-- Footer del sidebar -->
        <li class="sidebar-footer">
            <div class="theme-switch">
                <label class="switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>
                <span class="theme-label">Dark Mode</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="sidebar-link" type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>
    </aside>
</div>

