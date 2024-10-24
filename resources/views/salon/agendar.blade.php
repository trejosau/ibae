<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Resumen de la Cita</title>
    <style>
        .logo {
            width: auto;
            height: 64px;
        }

        header {
            background-color: #ccf3dc;
        }

        .main-content {
            padding: 20px;
        }

        .service-card {
            padding: 20px;
            border-top: 1px solid #b3b3b3;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin: 0;
        }

        .service-card:first-child {
            border-top: none;
        }

        .service-card:hover {
            background-color: #daf4e8;
        }

        .selected {
            background-color: #d1e7dd;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-item h6 {
            margin: 0;
        }

        .price {
            color: #333;
        }

        .resumen-servicios {
            position: fixed; /* Fijo en la parte superior */
            top: 120px; /* Distancia del top */
            right: 20px; /* Distancia del lado derecho */
            width: 300px; /* Ancho fijo del resumen */
            background-color: #ccf3dc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Para asegurarse de que esté por encima de otros elementos */
        }

        .service-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .service-description {
            font-weight: lighter;
            margin-bottom: 10px;
            color: #666;
        }

        .service-details {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #333;
        }

        .service-price {
            font-weight: bold;
        }

        .service-time {
            margin-left: 5px;
            color: #777;
        }

        .added-status {
            font-size: 12px;
            color: #28a745;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .added-status i {
            margin-right: 5px;
        }

        .d-none {
            display: none;
        }

        #next-button {
            width: 100%;
        }

        .timeline {
            position: relative;
            margin-top: 20px;
            padding-left: 20px; /* Reducir padding */
            border-left: 2px solid #28a745;
        }

        .timeline-event {
            position: relative;
            margin-bottom: 20px;
            padding-left: 40px; /* Más espacio para que el círculo esté centrado */
        }

        .timeline-event::before {
            content: '';
            position: absolute;
            left: -22px; /* Ajusta para centrarlo dentro de la línea */
            top: 50%; /* Alineación vertical */
            transform: translateY(-50%); /* Centrar en el medio */
            width: 12px;
            height: 12px;
            background-color: #28a745;
            border-radius: 50%;
            border: 2px solid white; /* Opcional: añade un borde blanco para darle estilo */
        }


    </style>
</head>
<body>

<header class="py-2">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{asset('images/logo-salon.jpg')}}" alt="Rosy Saucedo Salon" class="img-fluid w-100 h-100 object-fit-cover">
        </div>
        <div class="d-flex">
            <a href="#" class="btn btn-outline-primary me-2 d-flex align-items-center">
                <i class="fa fa-chevron-circle-left me-2"></i>
                Volver
            </a>
        </div>

        <div>
            <a href="#" class="btn btn-outline-primary mr-2">Iniciar sesión</a>
            <a href="https://www.facebook.com" target="_blank" class="facebook-icon">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
            </a>
        </div>
    </div>
</header>

<main class="main-content">
    <div class="container">
        <h2 class="be-vietnam-pro-semibold" style="margin-bottom: 20px; font-size: 1.5rem;">Servicios Disponibles</h2>
        <div class="row">
            <div class="col-md-8">


                <div class="service-card" data-service="Blowout" data-price="75" data-time="1 hora">
                    <h5 class="service-name">Blowout</h5>
                    <p class="service-description">Descripción del servicio de Blowout.</p>
                    <div class="service-details">
                        <span class="service-price">$75.00</span> &middot;
                        <span class="service-time">1 hora</span>
                    </div>
                    <p class="added-status d-none">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Added
                    </p>
                </div>

                <div class="service-card" data-service="Double Process" data-price="250" data-time="2 horas">
                    <h5 class="service-name">Double Process</h5>
                    <p class="service-description">Descripción del servicio de Double Process.</p>
                    <div class="service-details">
                        <span class="service-price">$250.00</span> &middot;
                        <span class="service-time">2 horas</span>
                    </div>
                    <p class="added-status d-none">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Added
                    </p>
                </div>

                <div class="service-card" data-service="Coloración" data-price="150" data-time="1.5 horas">
                    <h5 class="service-name">Coloración</h5>
                    <p class="service-description">Descripción del servicio de coloración.</p>
                    <div class="service-details">
                        <span class="service-price">$150.00</span> &middot;
                        <span class="service-time">1.5 horas</span>
                    </div>
                    <p class="added-status d-none">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Added
                    </p>
                </div>

                <div class="service-card" data-service="Corte de Cabello" data-price="50" data-time="30 minutos">
                    <h5 class="service-name">Corte de Cabello</h5>
                    <p class="service-description">Descripción del servicio de corte de cabello.</p>
                    <div class="service-details">
                        <span class="service-price">$50.00</span> &middot;
                        <span class="service-time">30 minutos</span>
                    </div>
                    <p class="added-status d-none">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Added
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="resumen-servicios">
        <h2>Resumen de la Cita</h2>
        <div class="appointment-summary">
            <h6 class="mb-2">Servicios Elegidos:</h6>
            <div id="timeline" class="timeline">
                <!-- Los servicios seleccionados aparecerán aqui-->
            </div>
            <div id="total-price" class="summary-item">
                <h6>Total:</h6>
                <h6 class="price">$0.00</h6>
            </div>
        </div>
        <a href="{{ route('salon.confirmar') }}" class="btn btn-primary mt-3" id="next-button">
            Siguiente <i class="fas fa-arrow-right"></i>
        </a>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceCards = document.querySelectorAll('.service-card');
        const timeline = document.getElementById('timeline');
        const totalPriceElement = document.querySelector('#total-price .price');
        let total = 0;

        serviceCards.forEach(card => {
            card.addEventListener('click', function () {
                const serviceName = card.getAttribute('data-service');
                const servicePrice = parseFloat(card.getAttribute('data-price'));
                const serviceTime = card.getAttribute('data-time');

                // Evitar seleccionar el mismo servicio más de una vez
                if (card.classList.contains('selected')) {
                    card.classList.remove('selected');
                    removeService(serviceName, servicePrice);
                } else {
                    card.classList.add('selected');
                    addService(serviceName, servicePrice, serviceTime);
                }
            });
        });

        function addService(name, price, time) {
            const event = document.createElement('div');
            event.classList.add('timeline-event');
            event.innerHTML = `
            <h6>${name}</h6>
            <p>Precio: $${price.toFixed(2)} &middot; Tiempo: ${time}</p>
        `;
            timeline.appendChild(event);

            total += price;
            updateTotalPrice();
        }

        function removeService(name, price) {
            const events = timeline.querySelectorAll('.timeline-event');
            events.forEach(event => {
                if (event.innerHTML.includes(name)) {
                    event.remove();
                }
            });

            total -= price;
            updateTotalPrice();
        }

        function updateTotalPrice() {
            totalPriceElement.textContent = `$${total.toFixed(2)}`;
        }
    });

</script>

</body>
</html>
