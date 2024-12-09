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
            <div class="container">
                <div class="row">
                    <!-- Columna principal -->
                    <div class="col-md-8">
                        <!-- Botón "Volver" reducido -->
                        <button wire:click="previousStep" class="btn btn-primary mb-3" style="width: auto; padding: 5px 15px; font-size: 0.9rem;">Volver</button>

                        <!-- Títulos -->
                        <h2 class="be-vietnam-pro-semibold" style="font-size: 1.5rem; font-weight: 600;">Elige un estilista y Horario</h2>
                        <h3 class="be-vietnam-pro-semibold mb-3" style="font-size: 1.2rem; font-weight: 600;">Duración total: {{ $duracionTotal }} minutos</h3>

                        <!-- Selección de estilista -->
                        <div class="form-group mb-3">
                            <label for="estilista" class="form-label">Elige un estilista</label>
                            <select wire:model.live="estilistaSeleccionada" id="estilista" class="form-control">
                                <option value="" selected>Selecciona una opción</option>
                                @foreach($estilistas as $estilista)
                                    <option value="{{ $estilista->id }}">{{ $estilista->Persona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @if ($estilistaSeleccionada)
                    <div class="row">
                        <!-- Fecha y Hora -->
                        <div class="col-md-6 mb-3">
                            <label for="pickDay">Seleccionar Fecha</label>
                            <input 
                                type="date" 
                                class="form-control" 
                                wire:model="fechaElegida" 
                                wire:change="obtenerHorariosLibres" 
                                min="{{ $fechaMinima }}" 
                                max="{{ $fechaMaxima }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pickTime">Seleccionar Hora</label>
                            <select id="pickTime" class="form-control" wire:model="horaElegida">
                                <option value="">Seleccione la hora</option>
                                @foreach ($horariosLibres as $hora)
                                    <option value="{{ \Carbon\Carbon::parse($hora)->format('H:i') }}">
                                        {{ \Carbon\Carbon::parse($hora)->format('H:i A') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                @endif

                <!-- Servicios seleccionados -->
                @if ($selectedServices)
                    <div class="row">
                        @foreach($selectedServices as $servicio)
                            <div class="col-md-6">
                                <div class="service-card p-3 mb-3 bg-light border rounded">
                                    <h5 class="service-name font-weight-bold mb-1">{{ $servicio->nombre }}</h5>
                                    <p class="service-description mb-2 text-muted">{{ $servicio->descripcion }}</p>
                                    <div class="service-details">
                                        <span class="service-price font-weight-bold">${{ $servicio->precio }}</span> &middot;
                                        <span class="service-time text-muted">{{ $servicio->duracion_maxima }} minutos</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div style="border-top: 2px solid #ddd; padding-top: 10px;">
                    <div class="total" style="margin-bottom: 10px; margin-top: 10px; font-size: 1.1rem; font-weight: bold;">
                        <strong>Total:</strong>
                        <span style="font-size: 1.2rem; color: #28a745;">
                            ${{ number_format(array_sum(array_map(function ($id) use ($servicios) {
                                return $servicios->find($id)->precio;
                            }, $selectedServices)), 2) }}
                        </span>
                    </div>
                    <p style="display: inline-block; margin-bottom: 10px; margin-top: 10px; font-size: 1.1rem; font-weight: bold;">
                      <strong>Anticipo:</strong> <span style="display: inline-block; font-size: 1.2rem; color: #28a745;">${{ number_format($anticipo, 2) }} </span> <p style="display: inline-block; padding-left:5px;" class="small">Esto es el 30% del total</p>
                    <p style="font-size: 1rem; color: #333; padding-top: 15px; line-height: 1.5;">
                        <strong style="font-weight: bold;">Para apartar tu cita:</strong> deberás pagar este anticipo. Se te redirigirá a otra pestaña para concretar la compra o de lo contrario se puede pagar toda la cita.
                    </p>
                    <div style="margin-top: 15px;">
                        <label for="paymentOption" style="font-size: 1rem; font-weight: bold; display: block; margin-bottom: 5px;">
                            Selecciona cómo deseas pagar:
                        </label>
                        <select id="paymentOption" name="paymentOption" style="margin-bottom: 10px; margin-top: 10px; width: 100%; padding: 10px; font-size: 1rem; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="anticipo">Pagar solo anticipo</option>
                            <option value="completo">Pagar cita completa</option>
                        </select>
                    </div>
                </div>
                
                

                
                <!-- Botón flotante Confirmar -->
                <button wire:click="confirmarCita" class="btn btn-success" style="padding: 10px 20px; font-size: 1rem; border-radius: 8px;">
                    Confirmar
                </button>
                
            </div>
        @endif


</div>




