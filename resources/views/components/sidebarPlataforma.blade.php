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
            <li class="sidebar-item">
                <a href="{{ route('home') }}" class="sidebar-link">
                    <i class="fa-solid fa-reply"></i>
                    <span>Volver a Inicio</span>
                </a>
            </li>
           
            @if(auth()->user()->hasAnyRole(['profesor', 'admin']))
            <!-- Código para la pestaña Cursos -->
            <li class="sidebar-item">
                <a href="#cursosDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#cursosDropdown" aria-expanded="false" aria-controls="cursosDropdown">
                    <i class="fa-solid fa-book"></i>
                    <span>Cursos</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="cursosDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{ route('plataforma.mis-cursos') }}" class="sidebar-link">Ver Cursos</a></li>
                    <li class="sidebar-item"><a href="{{route('plataforma.historial-cursos')}}" class="sidebar-link">Historial de Cursos</a></li>
                </ul>
            </li>
        @endif
        
        
        

            <!-- Sección para Módulos -->
            <li class="sidebar-item">
                <a href="#modulosDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#modulosDropdown" aria-expanded="false" aria-controls="modulosDropdown">
                    <i class="fa-solid fa-th-list"></i>
                    <span>Módulos</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="modulosDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{route('plataforma.lista-modulos')}}" class="sidebar-link">Ver Módulos</a></li>
                    <li class="sidebar-item"><a href="{{route('plataforma.temas-modulos')}}" class="sidebar-link">Ver Temas</a></li>
                </ul>
            </li>

            <!-- Sección para Estudiantes/Profesores -->
            <li class="sidebar-item">
                <a href="#estudiantesProfesoresDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#estudiantesProfesoresDropdown" aria-expanded="false" aria-controls="estudiantesProfesoresDropdown">
                    <!-- Nuevo ícono para Estudiantes/Profesores -->
                    <i class="fa-solid fa-chalkboard-teacher"></i>
                    <span>Personal</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="estudiantesProfesoresDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{route('plataforma.estudiantes')}}" class="sidebar-link">Lista de Estudiantes</a></li>
                    <li class="sidebar-item"><a href="{{route('plataforma.inscripciones')}}" class="sidebar-link">Inscripciones</a></li>
                    <li class="sidebar-item"><a href="{{route('plataforma.profesores')}}" class="sidebar-link">Lista de Profesores</a></li>

                </ul>
            </li>


            <!-- Sección de Finanzas -->
            <li class="sidebar-item">
                <a href="#finanzasDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#finanzasDropdown" aria-expanded="false" aria-controls="finanzasDropdown">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span>Finanzas</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="finanzasDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{route('plataforma.pagos')}}" class="sidebar-link">Pagos y Colegiaturas</a></li>
                    <li class="sidebar-item"><a href="{{route('plataforma.historial-pagos')}}" class="sidebar-link">Historial de Pagos</a></li>
                </ul>
            </li>

            <!-- Sección exclusiva para Estudiantes -->
            <li class="sidebar-item">
                <a href="#estudianteDropdown" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#estudianteDropdown" aria-expanded="false" aria-controls="estudianteDropdown">
                    <i class="fa-solid fa-user"></i>
                    <span>Mi espacio</span>
                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                </a>
                <ul id="estudianteDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{route('plataforma.espacio-mis-cursos')}}" class="sidebar-link">Mis Cursos</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('plataforma.espacio-mis-pagos')}}" class="sidebar-link">Mis Pagos</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('plataforma.espacio-perfil')}}" class="sidebar-link">Perfil / Configuración</a>
                    </li>
                </ul>
            </li>
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

