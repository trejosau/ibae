@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Formulario de contacto -->
        <div class="col-lg-5 contact-form">
            <h2 class="text-center mb-4 ">Contáctanos</h2>

            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" placeholder="Escribe tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="subject" placeholder="Escribe el asunto" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Escribe tu mensaje" required></textarea>
                </div>
                <button type="submit" class=" w-100 btn-custom">Enviar</button>
            </form>
        </div>

        <!-- Información de contacto -->
        <div class="info col-lg-5 contact-info mt-5 mt-lg-0 ms-lg-5">
            <h4 class="text-center">Información de Contacto</h4>
            <div class="d-flex align-items-center">
                <i class="bi bi-geo-alt me-3"></i>
                <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad Ejemplo</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-telephone me-3"></i>
                <p><strong>Teléfono:</strong> +123 456 7890</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-envelope me-3"></i>
                <p><strong>Correo:</strong> contacto@ejemplo.com</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-clock me-3"></i>
                <p><strong>Horario:</strong> Lunes a Viernes, 9 AM - 6 PM</p>
            </div>
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d225.01689772078407!2d-103.2286443!3d25.5293696!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc12cfd3c23c3%3A0xb149153182ebb682!2sAv.%20V.%20Carranza%202%2C%20Centro%2C%2027440%20Matamoros%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1729010616570!5m2!1ses-419!2smx" width="450" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="center">
            <a href="https://maps.app.goo.gl/8Nj58J5KquzNhz4x5" target="_blank" class=" btn-custom">Obtener indicaciones</a>
            </div>
        </div>
    </div>
</div>
@endsection
