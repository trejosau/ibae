<!-- Cargando la fuente Pacifico -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

<div class="services-section" style="padding: 80px 20px; background-color: #F8F9FA; text-align: center;">
    <h2 class="section-title" style="font-size: 3.5rem; font-weight: bold; color: #0D1E4C; margin-bottom: 20px; font-family: 'Pacifico', cursive; letter-spacing: 8px;">Servicios</h2>
    <p class="section-description" style="font-size: 1.2rem; color: #7A8A9A; margin-bottom: 50px; font-family: 'Pacifico', cursive; letter-spacing: 3px;">Descubre lo que tenemos para ofrecerte</p>

    <div class="services-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; justify-items: center; padding: 0 20px;">

        <!-- Curso -->
        <a href="{{ route('cursos.info') }}" class="service-item" style="position: relative; display: block; width: 100%; height: 350px; border-radius: 20px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="service-image" style="background-image: url('https://trendsstudio.com.mx/wp-content/uploads/2020/08/Trends-Studio-Curso-Maquillaje-de-Belleza-5-1.jpg');"></div>
            <div class="service-label">CURSOS</div>
        </a>

        <!-- Salón -->
        <a href="{{ route('salon.index') }}" class="service-item" style="position: relative; display: block; width: 100%; height: 350px; border-radius: 20px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="service-image" style="background-image: url('{{ asset('images/salon_desc.jpeg') }}');"></div>
            <div class="service-label">SALÓN</div>
        </a>

        <!-- Productos -->
        <a href="/tienda" class="service-item" style="position: relative; display: block; width: 100%; height: 350px; border-radius: 20px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="service-image" style="background-image: url('https://th.bing.com/th/id/R.dd9fcb778bae6a1cc637aa94b19fe03a?rik=xWOrlxfLkYdUdA');"></div>
            <div class="service-label">TIENDA</div>
        </a>
    </div>
</div>

<!-- Estilos mejorados -->
<style>
    .services-section {
        padding: 80px 20px;
        background-color: #F8F9FA;
        text-align: center;
    }

    .service-item {
        position: relative;
        display: block;
        width: 100%;
        height: 350px; /* Aseguramos que cada tarjeta tenga un alto visible */
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background-color: transparent;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .service-image {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        transition: filter 0.3s ease;
    }

    .service-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        font-weight: 700;
        font-family: 'Pacifico', cursive;
        color: white;
        text-transform: uppercase;
        letter-spacing: 5px;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        opacity: 0; /* Empezamos con el texto oculto */
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    /* Al pasar el ratón sobre la tarjeta, se hace visible el texto */
    .service-item:hover .service-label {
        opacity: 1; /* Hacemos el texto visible */
        transform: translate(-50%, -50%) scale(1.1); /* Le damos un pequeño zoom */
    }

    /* Al pasar el ratón sobre la tarjeta, se oscurece la imagen */
    .service-item:hover .service-image {
        filter: brightness(50%); /* Reduce el brillo de la imagen */
    }

    .services-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        justify-items: center;
        padding: 0 20px;
    }

    .service-item a {
        text-decoration: none;
    }
</style>
