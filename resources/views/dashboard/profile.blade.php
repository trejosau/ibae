@php
    // Simulación de datos del usuario
    $usuario = [
        'nombre_completo' => 'Juan Pérez',
        'email' => 'juan.perez@example.com',
        'telefono' => '123-456-7890',
        'direccion' => 'Calle Falsa 123',
        'foto' => 'https://th.bing.com/th/id/OIP.ptWtXRl15WkFas1-030N0gHaEJ?rs=1&pid=ImgDetMain',
        'dos_factor' => false,
        'roles' => ['Usuario', 'Administrador'],
    ];
@endphp

<div class="container-fluid mt-5">
    <div class="row">
        <!-- Contenido Principal -->
        <main class="col-md-9 col-lg-10 px-4 bg-light" id="contenido-principal" style="min-height: 80vh;">
            <h2 class="mt-4">Selecciona una sección</h2>
            <p>Aquí verás la información correspondiente a la sección seleccionada.</p>
        </main>
    </div>
</div>

<!-- Modal Subir Foto -->
<div class="modal fade" id="modal-subir-foto" tabindex="-1" aria-labelledby="modal-subir-foto-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-subir-foto-label">Subir Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSubirFoto" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="foto-perfil" class="form-label">Selecciona una nueva foto:</label>
                        <input type="file" class="form-control" id="foto-perfil" name="foto_perfil" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formSubirFoto').submit()">Subir Foto</button>
            </div>
        </div>
    </div>
</div>



<!-- Script para Subir Foto -->
<script>
    function subirFoto() {
        alert('Foto subida correctamente.');
        var modal = bootstrap.Modal.getInstance(document.getElementById('modal-subir-foto'));
        modal.hide();
    }

    function guardarInformacion() {
        alert('Información guardada correctamente.');
    }
</script>
