<div class="container" style="max-width: 1200px; padding: 20px;">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="z-index: 2000; position: relative;">
            <div class="alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="alert-text">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="z-index: 2000; position: relative;">
            <div class="alert-icon">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="alert-text">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($step == 1)
    <div class="row">
        <div class="col-md-8" style="padding-right: 20px;">
            <h2 class="be-vietnam-pro-semibold" style="margin-bottom: 20px; font-size: 1.5rem; font-weight: 600;">Servicios Disponibles</h2>
            @foreach($servicios as $servicio)
                <div class="service-card {{ collect($selectedServices)->pluck('id')->contains($servicio->id) ? 'selected' : '' }}"
                     wire:click="selectService({{ $servicio->id }})"
                     data-service="{{ $servicio->nombre }}"
                     data-price="{{ $servicio->precio }}"
                     data-time-maxima="{{ $servicio->duracion_maxima }} minutos"
                     style="padding: 20px; border-top: 1px solid #b3b3b3; cursor: pointer; transition: background-color 0.3s, transform 0.3s; margin: 0; border-radius: 8px; background-color: #fff;">
                    <h5 class="service-name" style="font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">{{ $servicio->nombre }}</h5>
                    <p class="service-description" style="font-size: 0.95rem; color: #666; margin-bottom: 10px;">{{ $servicio->descripcion }}</p>
                    <div class="service-details" style="font-size: 0.9rem; color: #333;">
                        <span class="service-price" style="font-weight: bold;">${{ $servicio->precio }}</span> &middot;
                        <span class="service-time" style="color: #777;">{{ $servicio->duracion_maxima }} minutos</span>
                    </div>
                    <p class="added-status d-none" style="font-size: 0.85rem; color: #28a745; margin-top: 5px; display: flex; align-items: center;">
                        <i class="fa fa-check-circle" aria-hidden="true" style="margin-right: 5px;"></i> Added
                    </p>
                    @if ($servicio->Categoria->nombre === 'Color')
                        <span class="badge bg-primary" style="font-size: 0.8rem; margin-left: 10px;">Color</span>
                    @endif
                </div>


            @endforeach
        </div>

        <!-- Resumen Fijo a la Derecha con Scroll para la lista de servicios y footer fijo -->
        <div class="col-md-4" style="position: sticky; top: 20px; background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); height: 500px; display: flex; flex-direction: column;">

            <!-- Resumen de los servicios seleccionados con Scroll -->
            <div class="resumen-servicios" style="flex-grow: 1; overflow-y: auto; margin-bottom: 20px; padding-right: 10px;">
                <h4 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 20px;">Resumen</h4>
                <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                    @foreach($selectedServices as $servicio)

                        <li style="margin-bottom: 10px;">
                            <strong style="font-size: 1rem;">{{ $servicio->nombre }}</strong>
                            <br><span style="font-size: 0.9rem; color: #333;">Precio: ${{ number_format($servicio->precio, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Footer Fijo con Total, Duración Total y Botón Siguiente -->
            <div style="border-top: 2px solid #ddd; padding-top: 10px;">
                <div class="total" style="margin-bottom: 10px; font-size: 1.1rem; font-weight: bold;">
                    <strong>Total:</strong>
                    <span style="font-size: 1.2rem; color: #28a745;">
                ${{ number_format(array_sum(array_map(function ($id) use ($servicios) {
                    return $servicios->find($id)->precio;
                }, $selectedServices)), 2) }}
            </span>
                </div>
                <div class="total-time" style="font-size: 1rem; color: #333;">
                    <strong>Duración Total:</strong>
                    <span>{{ array_sum(array_map(function ($id) use ($servicios) {
                return $servicios->find($id)->duracion_maxima;
            }, $selectedServices)) }} minutos</span>
                </div>

                <!-- Botón de Continuar -->
                <div class="text-center" style="margin-top: 20px;">
                    <button wire:click="nextStep" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 1rem;">
                        Continuar
                    </button>
                </div>


            </div>

        </div>
    </div>
    @endif
        @if ($step == 2)
            <div class="col-md-8" style="padding-right: 20px;">
                <!-- Botón "Volver" reducido -->
                <button wire:click="previousStep" class="btn btn-primary" style="width: auto; padding: 5px 15px; font-size: 0.9rem; margin-bottom: 20px;">
                    Volver
                </button>

                <!-- Título -->
                <h2 class="be-vietnam-pro-semibold" style="margin-bottom: 20px; font-size: 1.5rem; font-weight: 600;">Elige un estilista y Horario</h2>
                <h3 class="be-vietnam-pro-semibold" style="margin-bottom: 20px; font-size: 1.2rem; font-weight: 600;">Duración total: {{ $duracionTotal }} minutos</h3>

                <!-- Select para elegir una opción -->
                <div class="mb-3">
                    <label for="estilista" class="form-label">Elige un estilista</label>
                    <select wire:model.live="estilistaSeleccionada" id="estilista" class="form-control" style="width: 100%; padding: 10px; font-size: 1rem;">
                        <option value="" selected>Selecciona una opción</option>
                        @foreach($estilistas as $estilista)
                            <option value="{{ $estilista->id }}">{{ $estilista->Persona->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
            @if ($estilistaSeleccionada)
                <div class="container">
                    <div class="row">
                        <!-- Campo para seleccionar la fecha -->
                        <div class="col-md-6 mb-3">
                            <label for="pickDay">Seleccionar Fecha</label>
                            <input type="date" wire:model="fechaElegida" wire:change="obtenerHorariosLibres">
                        </div>


                        <!-- Campo para seleccionar la hora -->
                        <div class="col-md-6 mb-3">
                            <label for="pickTime">Seleccionar una hora disponible para el día {{ $fechaElegida }}</label>
                            <select id="pickTime" class="form-control" wire:model="horaElegida">
                                <option value="">Seleccione la hora</option>
                                @foreach ($horariosLibres as $hora)
                                    <option value="{{ \Carbon\Carbon::parse($hora)->format('H:i') }}">
                                        {{ \Carbon\Carbon::parse($hora)->format('H:i A') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center" style="margin-top: 20px;">
                            <select name="largo" id="largo" class="form-select" style="margin-bottom: 10px;">
                                <option value="" disabled selected>Selecciona el largo</option>
                                <option value="corto">Corto</option>
                                <option value="medio">Medio</option>
                                <option value="largo">Largo</option>
                            </select>

                            <select name="estado" id="estado" class="form-select" style="margin-bottom: 10px;">
                                <option value="" disabled selected>Selecciona el estado</option>
                                <option value="nuevo">Nuevo</option>
                                <option value="usado">Usado</option>
                                <option value="dañado">Dañado</option>
                            </select>

                            <select name="volumen" id="volumen" class="form-select" style="margin-bottom: 10px;">
                                <option value="" disabled selected>Selecciona el volumen</option>
                                <option value="bajo">Bajo</option>
                                <option value="medio">Medio</option>
                                <option value="alto">Alto</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Botón flotante de confirmar -->
                <div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
                    <button wire:click="confirmarCita" class="btn btn-success" style="padding: 15px 30px; font-size: 1.2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        Confirmar
                    </button>
                </div>
            @endif
            <!-- Mostrar fecha y hora solo si se seleccionó un estilista -->

                <!-- Servicios seleccionados -->
                @foreach($selectedServices as $servicio)
                    <div class="col-md-8" style="padding-right: 20px;">
                        <div class="service-card" style="padding: 20px; border-top: 1px solid #b3b3b3; margin: 0; border-radius: 8px; background-color: #fff;">
                            <h5 class="service-name" style="font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">{{ $servicio->nombre }}</h5>
                            <p class="service-description" style="font-size: 0.95rem; color: #666; margin-bottom: 10px;">{{ $servicio->descripcion }}</p>
                            <div class="service-details" style="font-size: 0.9rem; color: #333;">
                                <span class="service-price" style="font-weight: bold;">${{ $servicio->precio }}</span> &middot;
                                <span class="service-time" style="color: #777;">{{ $servicio->duracion_maxima }} minutos</span>
                            </div>
                        </div>
                    </div>
                @endforeach

        @endif

</div>




