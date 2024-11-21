@extends('layouts.app')

@section('content')
<style>
    /* Navegación */
    .navbar {
        background-color: rgb(255, 105, 135);
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    .navbar-brand, .nav-link {
        color: white !important;
        font-weight: bold;
    }

    /* Hero section */
    .hero {
        background-image: url('images/woman-posing-with-plant-side-view.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        position: relative;
    }
    .card-img-top {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    width: 100%; /* Añadido para que ocupe el ancho completo */
    height: auto;
}


    .hero-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    .hero h1 {
        font-size: 4rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .hero p {
        font-size: 1.5rem;
    }

    .btn-hero {
        background: linear-gradient(135deg, #ff6b6b, #ff4757);
        border: none;
        padding: 10px 30px;
        font-size: 1.2rem;
        margin-top: 20px;
        transition: transform 0.3s ease;
    }

    .btn-hero:hover {
        transform: scale(1.1);
    }

    /* Cursos section */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .btn-primary {
        background-color: #ff4757;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #e04040;
        transform: scale(1.05);
    }

    .card-body {
        background: linear-gradient(145deg, #fff, #f9f9f9);
        padding: 20px;
        text-align: center;
    }

    .icon-style {
        color: #ff6b6b;
        margin-right: 5px;
    }

    /* Información adicional */
    .info-section {
        background: linear-gradient(135deg, #f7f7f7, #ffffff);
        padding: 50px 20px;
        text-align: center;
    }

    .info-section h3 {
        color: #444;
        margin-bottom: 20px;
        font-size: 2.5rem;
    }

    .info-section p {
        color: #666;
        font-size: 1.2rem;
    }

    .reveal {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<div class="hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="reveal">Cursos de Belleza Profesional</h1>
        <p class="lead reveal">Conviértete en un experto en el mundo de la belleza</p>
        <a href="#courses" class="btn btn-lg btn-hero reveal">Descubre Nuestros Cursos</a>
    </div>
</div>


<div class="container mt-5" id="courses">
    <h2 class="text-center mb-4 reveal fw-bold fs-5 pt-5">Nuestros Cursos</h2>
    <div class="row">
        <div class="col-md-4 reveal">
            <div class="card mb-4">
                <img src="{{asset('images/client-doing-hair-cut-barber-shop-salon.jpg')}}" class="card-img-top" alt="Curso de Maquillaje">
                <div class="card-body">
                    <h5 class="card-title pb-3">Cursos de Barberia</h5>
                    <p class="card-text pb-3">Técnicas avanzadas de maquillaje con prácticas en modelos reales.</p>
                    <p><i class="fas fa-clock icon-style pb-3"></i>3 meses</p>
                    <p><i class="fas fa-dollar-sign icon-style pb-3"></i>$500 USD</p>
                    <a href="#" class="btn btn-primary pb-3">Inscribirse</a>
                </div>
            </div>
        </div>
        <!-- Curso 2 -->
        <div class="col-md-4 reveal">
            <div class="card mb-4">
                <img src="{{asset('images/make-up-artist-wearing-medical-mask-reflection-mirror.jpg')}}" class="card-img-top alt="Curso de Estilismo">
                <div class="card-body">
                    <h5 class="card-title pb-3">Curso de Uñas, Maquillaje y Peinado</h5>
                    <p class="card-text pb-3">Conviértete en un experto estilista, cortes y peinados profesionales.</p>
                    <p><i class="fas fa-clock icon-style pb-3"></i>6 meses</p>
                    <p><i class="fas fa-dollar-sign icon-style pb-3"></i>$800 USD</p>
                    <a href="#" class="btn btn-primary pb-3">Inscribirse</a>
                </div>
            </div>
        </div>
        <!-- Curso 3 -->
        <div class="col-md-4 reveal">
            <div class="card mb-4">
                <img src="{{asset('images/side-view-woman-hair-salon.jpg')}}" class="card-img-top" alt="Curso de Uñas">
                <div class="card-body">
                    <h5 class="card-title pb-3">Carrera de Estilismo y Diseño de Imagen</h5>
                    <p class="card-text pb-3">Domina técnicas de aplicación de uñas esculpidas, gel y acrílico.</p>
                    <p><i class="fas fa-clock icon-style pb-3"></i>2 meses</p>
                    <p><i class="fas fa-dollar-sign icon-style pb-3"></i>$300 USD</p>
                    <a href="#" class="btn btn-primary pb-3">Inscribirse</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Información adicional -->
<div class="info-section mt-5">
    <h3 class="reveal">Transforma tu pasión en una carrera exitosa</h3>
    <p class="lead reveal">Nuestros cursos están diseñados para brindarte las herramientas necesarias para triunfar en el mundo de la belleza.</p>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* Efecto de revelado en scroll */
    window.addEventListener('scroll', function() {
        let reveals = document.querySelectorAll('.reveal');
        for (let i = 0; i < reveals.length; i++) {
            let windowHeight = window.innerHeight;
            let revealTop = reveals[i].getBoundingClientRect().top;
            let revealPoint = 150;

            if (revealTop < windowHeight - revealPoint) {
                reveals[i].classList.add('visible');
            } else {
                reveals[i].classList.remove('visible');
            }
        }
    });
</script>
@endsection
