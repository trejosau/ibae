<div class="d-flex" style="height: 100vh;">
    <!-- Sidebar -->
    <div class="p-3 bg-light border-end" style="width: 300px;" x-data="{ esEstudiante: @entangle('esEstudiante') }">
        <h5>Detalles del Comprador</h5>

        <!-- Checkbox para "¿Es estudiante?" -->
        <div class="mb-3 form-check">
            <input
                type="checkbox"
                id="esEstudiante"
                class="form-check-input"
                x-model="esEstudiante"
            >
            <label for="esEstudiante" class="form-check-label">¿Es estudiante?</label>
        </div>

        <!-- Si es estudiante, mostrar el componente de búsqueda -->
        <div x-show="esEstudiante" class="mb-3">
            <livewire:buscador-estudiantes />
        </div>

    </div>
</div>
