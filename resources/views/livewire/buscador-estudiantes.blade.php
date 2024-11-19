<div x-data="{ open: false, selected: '', query: @entangle('query'), selectedNombre: '' }" x-on:click.away="open = false" class="position-relative">
    <!-- Campo de búsqueda -->
    <input
        type="text"
        class="form-control"
        placeholder="Buscar estudiante..."
        wire:model.live.debounce.300ms="query"
        x-model="query"
        x-on:focus="open = true"
        x-on:input="open = true"
        style="border-radius: 0.375rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
    />

    <!-- Nombre del estudiante seleccionado (opcional) -->
    <div x-show="selected" class="mt-2">
        <p><strong>Nombre seleccionado:</strong> <span x-text="selectedNombre"></span></p>
    </div>

    <!-- Dropdown con los resultados -->
    <ul x-show="open && query.length > 0"
        x-transition
        class="list-group mt-2"
        style="max-height: 300px; overflow-y: auto; background-color: #f8f9fa; border-radius: 0.375rem;">
        <!-- Header del dropdown -->
        <li class="list-group-item text-center font-weight-bold" style="background-color: #e2f0f7; color: #007bff;">
            Nombre | Matrícula
        </li>

        @forelse ($resultados as $estudiante)
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
                x-on:click="
                    selected = '{{ $estudiante->id }}';
                    query = '{{ $estudiante->matricula }}';
                    selectedNombre = '{{ $estudiante->Persona->nombre }}';
                    open = false;
                "
                style="cursor: pointer; transition: background-color 0.3s ease, color 0.3s ease;">
                <span>{{ $estudiante->Persona->nombre }}</span>
                <span class="text-muted">{{ $estudiante->matricula }}</span>
            </li>
        @empty
            <li class="list-group-item text-muted text-center">Sin resultados.</li>
        @endforelse
    </ul>

    <!-- Estilos adicionales para hover y colores pastel -->
    <style>
        /* Efecto hover sobre los elementos del dropdown */
        .list-group-item:hover {
            background-color: #d1ecf1; /* Color pastel suave */
            color: #0056b3; /* Color de texto al hacer hover */
        }

        /* Estilo del input */
        .form-control {
            background-color: #f1f3f5;
            border: 1px solid #ccc;
        }

        /* Estilo para los resultados */
        .list-group-item {
            padding: 12px 15px;
            border-radius: 0.375rem;
        }
    </style>
</div>
