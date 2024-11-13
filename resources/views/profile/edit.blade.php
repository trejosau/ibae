@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')

    <style>
        .profile-image-container {
            position: relative;
        }

        .edit-icon-overlay {
            display: none; /* Oculta el ícono inicialmente */
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
            color: white;
            transition: opacity 0.3s ease; /* Efecto de transición suave en la opacidad */
            opacity: 0;
        }

        .profile-image-container:hover .edit-icon-overlay {
            display: flex; /* Muestra el ícono al hacer hover */
            opacity: 1;
        }

        /* Estilo para el botón circular con ícono */
        .photo-upload-btn {
            position: relative;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6a11cb, #2575fc); /* Gradiente de fondo */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
        }

        .photo-upload-btn input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .photo-upload-btn i {
            color: #fff;
            font-size: 2rem;
            transition: transform 0.2s ease;
        }

        .photo-upload-btn:hover i {
            transform: scale(1.1); /* Aumenta el icono en hover */
        }

        /* Efecto de gradiente en el botón de guardar imagen */
        .btn-gradient {
            background: linear-gradient(135deg, #ff6b6b, #f06595);
            color: #fff;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #f06595, #ff6b6b);
        }
        </style>


    <!-- Modal para actualizar foto de perfil -->
    <div class="modal fade" id="editProfilePhotoModal" tabindex="-1" aria-labelledby="editProfilePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilePhotoModalLabel">Actualizar Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Formulario para enviar la imagen y los datos de recorte -->
                    <form method="POST" action="{{ route('profile.imageUpdate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="main_photo_update" class="form-label d-block">Foto Principal</label>
                            <div class="d-flex justify-content-center">
                                <div class="photo-upload-btn position-relative">
                                    <!-- Input de tipo archivo -->
                                    <input type="file" class="form-control position-absolute top-0 start-0 opacity-0" id="main_photo_update" name="main_photo" accept="image/*" style="width: 100%; height: 100%;" onchange="previewImageUpdate(event)">

                                    <!-- Ícono del botón -->
                                    <div class="btn-circle d-flex align-items-center justify-content-center" style="position: absolute; z-index: 10; pointer-events: none;">
                                        <i class="fa fa-camera fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenedor para la imagen y el área de recorte -->
                            <div class="mt-4">
                                <img id="image_to_crop_update" src="#" alt="Image to crop" style="max-width: 100%; display: none; border-radius: 8px;">
                            </div>
                            <!-- Campos ocultos para los datos de recorte -->
                            <input type="hidden" id="crop_x_update" name="crop_x">
                            <input type="hidden" id="crop_y_update" name="crop_y">
                            <input type="hidden" id="crop_width_update" name="crop_width">
                            <input type="hidden" id="crop_height_update" name="crop_height">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-gradient">Guardar imagen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        let cropperUpdate;

        function previewImageUpdate(event) {
            if (event.target.files.length === 0) {
                return;
            }

            var imageUpdate = document.getElementById('image_to_crop_update');
            var readerUpdate = new FileReader();

            readerUpdate.onload = function () {
                imageUpdate.src = readerUpdate.result;
                imageUpdate.style.display = 'block';

                if (cropperUpdate) {
                    cropperUpdate.destroy();
                }

                cropperUpdate = new Cropper(imageUpdate, {
                    aspectRatio: 1,
                    crop(event) {
                        document.getElementById('crop_x_update').value = event.detail.x;
                        document.getElementById('crop_y_update').value = event.detail.y;
                        document.getElementById('crop_width_update').value = event.detail.width;
                        document.getElementById('crop_height_update').value = event.detail.height;
                    }
                });
            };
            readerUpdate.readAsDataURL(event.target.files[0]);
        }
    </script>


    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Password change form -->
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>


    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="profile-image-container position-relative d-inline-block mt-5">
                        <img class="rounded-circle profile-img" width="150px" src="{{ $user->profile_photo_url }}" alt="Profile Image">
                        <a href="#" class="edit-icon-overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white rounded-circle" data-bs-toggle="modal" data-bs-target="#editProfilePhotoModal">
                            <i class="fa fa-pencil fa-3x"></i>
                        </a>
                    </div>

                    <span class="font-weight-bold">{{ $user->username }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Informacion personal</h4>
                                    <button class="btn btn-primary profile-button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        Cambiar Contraseña
                                    </button>
                                    <form method="POST" action="{{ route('profile.update') }}">
                                        @method('PUT')
                                    <button class="btn btn-primary profile-button" type="submit">Guardar Perfil</button>
                                </div>

                                    @csrf

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label class="labels">Username</label>
                                            <input type="text" class="form-control" name="username" placeholder="username" value="{{  $user->username }}">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label class="labels">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre', optional($user->persona)->nombre) }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="labels">Apellido Materno</label>
                                            <input type="text" class="form-control" name="ap_materno" value="{{ old('ap_materno', optional($user->persona)->ap_materno) }}" placeholder="Apellido Materno">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Apellido Paterno</label>
                                            <input type="text" class="form-control" name="ap_paterno" value="{{ old('ap_paterno', optional($user->persona)->ap_paterno) }}" placeholder="Apellido Paterno">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono" value="{{ old('telefono', optional($user->persona)->telefono) }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Razón Social</label>
                                            <input type="text" class="form-control" name="razon_social" placeholder="Salon de belleza trc" value="{{ $user->persona->comprador->razon_social }}">
                                        </div>

                            <div class="col-md-12 mt-2">
                                <label class="labels">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="Ingrese email" value="{{ $user->email }}" {{ $user->email_verified_at ? 'readonly' : '' }}>

                                    <!-- Condición para verificar el estado del correo -->
                                    @if ($user->email_verified_at)
                                        <!-- Si el correo está verificado -->
                                        <button class="btn btn-success" disabled>
                                            <i class="fa fa-check-circle"></i> Verificado
                                        </button>
                                    @else
                                        <!-- Si el correo no está verificado -->
                                        <form action="" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-envelope"></i> Verificar Email
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                                        </form>


                        </div>
                        <hr>
                        <h6 class="text-center mb-3">Dirección</h6>
                        @php
                            $direccion = null;
                            if(optional($user->persona)->estudiante && !optional($user->persona)->profesor) {  // Solo estudiante
                                $direccion = $user->persona->estudiante;
                            } elseif(optional($user->persona)->profesor && !optional($user->persona)->estudiante) {  // Solo profesor
                                $direccion = $user->persona->profesor;
                            } elseif(optional($user->persona)->estudiante && optional($user->persona)->profesor) {// Ambos, preferir estudiante
                                $direccion = $user->persona->estudiante;
                            }
                        @endphp

                        @if($direccion)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Código Postal</label>
                                    <input type="text" class="form-control" placeholder="Código Postal" value="{{ $direccion->zipcode }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Ciudad</label>
                                    <input type="text" class="form-control" placeholder="Ciudad" value="{{ $direccion->ciudad }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Colonia</label>
                                    <input type="text" class="form-control" placeholder="Colonia" value="{{ $direccion->colonia }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Calle</label>
                                    <input type="text" class="form-control" placeholder="Calle" value="{{ $direccion->calle }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Número Exterior</label>
                                    <input type="text" class="form-control" placeholder="Número Exterior" value="{{ $direccion->num_ext }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Número Interior</label>
                                    <input type="text" class="form-control" placeholder="Número Interior" value="{{ $direccion->num_int }}" disabled>
                                </div>
                            </div>
                        @endif


                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <h6 class="text-center mb-3">Información de estudiante</h6>
                    {{-- Sección para estudiantes --}}
                    @if(optional($user->persona)->estudiante)
                        <div class="form-group">
                            <label class="labels">Matrícula</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->estudiante)->matricula }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="labels">Fecha de Inscripción</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->estudiante)->fecha_inscripcion }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="labels">Precio de Inscripción</label>
                            <input type="text" class="form-control" value="{{ optional(optional($user->persona->estudiante)->inscripcion)->precio }}" disabled>
                        </div>
                    @endif

                    <hr>


                    @if(optional($user->persona)->profesor)
                        <h6 class="text-center mb-3">Información de profesor</h6>
                        <div class="form-group">
                            <label class="labels">Especialidad</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->profesor)->especialidad }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="labels">Fecha de Contratación</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->profesor)->fecha_contratacion }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="labels">RFC</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->profesor)->RFC }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="labels">CURP</label>
                            <input type="text" class="form-control" value="{{ optional($user->persona->profesor)->CURP }}" disabled>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
