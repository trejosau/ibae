<div class="container my-4">
    <h2 class="text-center mb-4">Gestión de Módulos y Temas</h2>

    <!-- Filtro por Categoría -->
    <div class="mb-4">
        <label for="categoryFilter" class="form-label">Filtrar por Categoría</label>
        <select class="form-select" id="categoryFilter">
            <option selected>Todas</option>
            <option value="barberia">Barbería</option>
            <option value="belleza">Belleza</option>
        </select>
    </div>

    <div class="row">
        <!-- Módulos -->
        <div class="col-md-6">
            <h3>Lista de Módulos</h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Nombre del Módulo</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Módulo 1: Técnicas de Corte</td>
                    <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModuleModal">Modificar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModuleModal">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Módulo 2: Maquillaje Profesional</td>
                    <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModuleModal">Modificar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModuleModal">Eliminar</button>
                    </td>
                </tr>
                <!-- Más módulos aquí -->
                </tbody>
            </table>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addModuleModal">Agregar Módulo</button>
        </div>

        <!-- Temas -->
        <div class="col-md-6">
            <h3>Lista de Temas</h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Nombre del Tema</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tema 1: Técnicas de Desvanecimiento</td>
                    <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editThemeModal">Modificar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteThemeModal">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Tema 2: Técnicas de Contorno</td>
                    <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editThemeModal">Modificar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteThemeModal">Eliminar</button>
                    </td>
                </tr>
                <!-- Más temas aquí -->
                </tbody>
            </table>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addThemeModal">Agregar Tema</button>
        </div>
    </div>

    <!-- Modales -->
    <!-- Agregar Módulo -->
    <div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModuleModalLabel">Agregar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="moduleName" class="form-label">Nombre del Módulo</label>
                            <input type="text" class="form-control" id="moduleName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Tema -->
    <div class="modal fade" id="addThemeModal" tabindex="-1" aria-labelledby="addThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addThemeModalLabel">Agregar Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="themeName" class="form-label">Nombre del Tema</label>
                            <input type="text" class="form-control" id="themeName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modificar Módulo -->
    <div class="modal fade" id="editModuleModal" tabindex="-1" aria-labelledby="editModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModuleModalLabel">Modificar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editModuleName" class="form-label">Nombre del Módulo</label>
                            <input type="text" class="form-control" id="editModuleName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modificar Tema -->
    <div class="modal fade" id="editThemeModal" tabindex="-1" aria-labelledby="editThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editThemeModalLabel">Modificar Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editThemeName" class="form-label">Nombre del Tema</label>
                            <input type="text" class="form-control" id="editThemeName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Eliminar Módulo -->
    <div class="modal fade" id="deleteModuleModal" tabindex="-1" aria-labelledby="deleteModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModuleModalLabel">Eliminar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este módulo?</p>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Eliminar Tema -->
    <div class="modal fade" id="deleteThemeModal" tabindex="-1" aria-labelledby="deleteThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteThemeModalLabel">Eliminar Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este tema?</p>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
