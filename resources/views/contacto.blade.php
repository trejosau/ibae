@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #F8F9FA; color: #26415E;">
        <div class="row justify-content-center">
            <!-- Información de contacto -->
            <div class="info col-lg-5 contact-info mt-5 mt-lg-0 ms-lg-5" style="background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4 class="text-center" style="color: #0D1E4C;">Información de Contacto</h4>
                <div class="d-flex align-items-center mb-3" style="color: #26415E;">
                    <i class="bi bi-geo-alt me-3" style="color: #83A6CE;"></i>
                    <p><strong>Dirección:</strong> Matamoros Centro, Av. V. Carranza 2 Altos, 27440 Matamoros, Coah.</p>
                </div>
                <div class="d-flex align-items-center mb-3" style="color: #26415E;">
                    <i class="bi bi-telephone me-3" style="color: #83A6CE;"></i>
                    <p><strong>Teléfono:</strong> +871 534 8926</p>
                </div>
                <div class="d-flex align-items-center mb-3" style="color: #26415E;">
                    <i class="bi bi-envelope me-3" style="color: #83A6CE;"></i>
                    <p><strong>Correo:</strong> inst.ibae@gmail.com</p>
                </div>
                <div class="d-flex align-items-center mb-3" style="color: #26415E;">
                    <i class="bi bi-clock me-3" style="color: #83A6CE;"></i>
                    <p><strong>Horario:</strong> Lunes a Domingo de 8:00 a 20:00</p>
                </div>
                <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d225.01689772078407!2d-103.2286443!3d25.5293696!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc12cfd3c23c3%3A0xb149153182ebb682!2sAv.%20V.%20Carranza%202%2C%20Centro%2C%2027440%20Matamoros%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1729010616570!5m2!1ses-419!2smx" width="450" height="250" style="border: 0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="text-center mt-3">
                    <a href="https://maps.app.goo.gl/8Nj58J5KquzNhz4x5" target="_blank" class="btn" style="background-color: #C48CB3; color: #FFFFFF; border-radius: 5px; padding: 10px 20px; text-decoration: none;">Obtener indicaciones</a>
                </div>
            </div>
        </div>
    </div>
@endsection
