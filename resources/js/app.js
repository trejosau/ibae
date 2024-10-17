import './bootstrap';
import 'bootstrap';
import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";
initMDB({ Dropdown, Collapse });
import $ from 'jquery';
import '@splidejs/splide/css';
import '@splidejs/splide/css/skyblue';
import '@splidejs/splide/css/sea-green';
import '@splidejs/splide/css/core';

document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/') {
        // Animación por frames
        const frames = document.querySelectorAll('.frame');
        let frameIndex = 0;
        const totalFrames = frames.length;
        let lastScrollY = 0;
        let isScrolling = false;

        // Mostrar el primer frame al cargar la página
        window.addEventListener('scroll', () => {
            if (!isScrolling) {
                isScrolling = true;
                requestAnimationFrame(() => {
                    const maxScrollTop = document.body.scrollHeight - window.innerHeight;
                    const currentScroll = window.scrollY;

                    // Hacer el cambio de frame más lento
                    const scrollPerFrame = maxScrollTop / (totalFrames + 120); // Ajusta el divisor para hacer la animación más lenta

                    const newFrameIndex = Math.min(Math.floor(currentScroll / scrollPerFrame), totalFrames - 1);

                    if (newFrameIndex !== frameIndex) {
                        frames[frameIndex].style.display = 'none'; // Oculta el frame anterior
                        frameIndex = newFrameIndex;
                        frames[frameIndex].style.display = 'block'; // Muestra el nuevo frame
                    }

                    lastScrollY = currentScroll;
                    isScrolling = false;
                });
            }
        });

        // Animación de los servicios
        const serviceItems = document.querySelectorAll('.service-item');

        // Configura el IntersectionObserver
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show'); // Activa la animación
                    observer.unobserve(entry.target); // Deja de observar el elemento
                }
            });
        }, { threshold: 0.2 }); // El 20% del elemento debe ser visible para disparar la animación

        // Aplica el observer a cada 'service-item'
        serviceItems.forEach(item => observer.observe(item));

        // Animación del mapa
        const mapContainer = document.querySelector('.map-container');

        // Configuración del IntersectionObserver
        const observermap = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show'); // Activa la animación
                    observermap.unobserve(entry.target); // Deja de observar después de la animación
                }
            });
        }, { threshold: 0.2 }); // La animación se dispara al ver el 20% del contenedor

        // Observamos el contenedor del mapa
        observermap.observe(mapContainer);

        // Fijar navbar
        const navbar = $('#navbar');
        const navbarOffset = navbar.offset().top;

        let lastScrollTop = 0;
        let ticking = false;

        $(window).on('scroll', function () {
            lastScrollTop = $(this).scrollTop();

            if (!ticking) {
                window.requestAnimationFrame(function () {
                    if (lastScrollTop >= navbarOffset) {
                        navbar.addClass('fixed');
                    } else {
                        navbar.removeClass('fixed');
                    }
                    ticking = false;
                });

                ticking = true;
            }
        });
    }

    if (window.location.pathname.startsWith('/dashboard/')) {
        const elementos = document.querySelector(".toggle-btn");
        const iconOpen = elementos.querySelector(".bi-grid-1x2"); // Icono cuando el sidebar está cerrado
        const iconClose = elementos.querySelector(".bi-grid-1x2-fill"); // Icono cuando el sidebar está abierto

        elementos.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");

            // Alternar iconos
            if (document.querySelector("#sidebar").classList.contains("expand")) {
                iconOpen.classList.add("hidden");
                iconClose.classList.remove("hidden");
            } else {
                iconOpen.classList.remove("hidden");
                iconClose.classList.add("hidden");
            }
        });

        function actualizarFechaHora() {
            const hoy = new Date();
            const dia = String(hoy.getDate()).padStart(2, '0');
            const mes = String(hoy.getMonth() + 1).padStart(2, '0');
            const anio = hoy.getFullYear();
            const horas = String(hoy.getHours()).padStart(2, '0');
            const minutos = String(hoy.getMinutes()).padStart(2, '0');
            const segundos = String(hoy.getSeconds()).padStart(2, '0');
            document.getElementById('fecha-hora').textContent =
                `${dia}/${mes}/${anio} ${horas}:${minutos}:${segundos}`;
        }
        setInterval(actualizarFechaHora, 1000);  // Actualiza cada segundo
    }

    if (window.location.pathname === '/register') {
        $(document).ready(function() {
            // Verificar si estamos en la página de registro
            if (window.location.pathname === '/register') {
                const passwordInput = $('#password');
                const rules = {
                    minLength: $('#minLength'),
                    mixedCase: $('#mixedCase'),
                    letters: $('#letters'),
                    numbers: $('#numbers'),
                    symbols: $('#symbols')
                };

                passwordInput.on('input', function() {
                    const password = passwordInput.val();
                    console.log("Contraseña actual:", password); // Depuración

                    // Regla: Al menos 8 caracteres
                    if (password.length >= 8) {
                        rules.minLength.removeClass('alert-danger').addClass('alert-success');
                    } else {
                        rules.minLength.removeClass('alert-success').addClass('alert-danger');
                    }

                    // Regla: Al menos una mayúscula y una minúscula
                    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) {
                        rules.mixedCase.removeClass('alert-danger').addClass('alert-success');
                    } else {
                        rules.mixedCase.removeClass('alert-success').addClass('alert-danger');
                    }

                    // Regla: Al menos una letra
                    if (/[a-zA-Z]/.test(password)) {
                        rules.letters.removeClass('alert-danger').addClass('alert-success');
                    } else {
                        rules.letters.removeClass('alert-success').addClass('alert-danger');
                    }

                    // Regla: Al menos un número
                    if (/\d/.test(password)) {
                        rules.numbers.removeClass('alert-danger').addClass('alert-success');
                    } else {
                        rules.numbers.removeClass('alert-success').addClass('alert-danger');
                    }

                    // Regla: Al menos un símbolo
                    if (/[\W_]/.test(password)) {
                        rules.symbols.removeClass('alert-danger').addClass('alert-success');
                    } else {
                        rules.symbols.removeClass('alert-success').addClass('alert-danger');
                    }
                });
            }
        });
    }
});
