<div class="d-flex" style="height: 100vh;">
    <div class="p-3 bg-light border-end" style="width: 300px;">
        <h5>Detalles del Comprador</h5>

        <!-- Checkbox "¿Es estudiante?" -->
        <div class="mb-3 form-check">
            <input type="checkbox" id="esEstudiante" class="form-check-input" wire:model="esEstudiante">
            <label for="esEstudiante" class="form-check-label">¿Es estudiante?</label>
        </div>

        <!-- Mostrar valor de "¿Es estudiante?" -->
        <div>
            <p>Valor de "¿Es estudiante?": <strong>{{ $esEstudiante ? 'true' : 'false' }}</strong></p>
        </div>

        <!-- Campo de Matrícula (se muestra solo si es estudiante) -->
        @if($esEstudiante)
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" id="matricula" class="form-control" wire:model="matricula">
            </div>
        @endif
    </div>
</div>
