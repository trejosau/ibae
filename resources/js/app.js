import './bootstrap';
import 'bootstrap';
import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";
initMDB({ Dropdown, Collapse });
import $ from 'jquery';


// animacion por frames

const frames = document.querySelectorAll('.frame');
let frameIndex = 0;
const totalFrames = frames.length;
let lastScrollY = 0;
let isScrolling = false;

// Mostrar el primer frame al cargar la página
frames[frameIndex].style.display = 'block';

window.addEventListener('scroll', () => {
    if (!isScrolling) {
        isScrolling = true;
        requestAnimationFrame(() => {
            const maxScrollTop = document.body.scrollHeight - window.innerHeight;
            const currentScroll = window.scrollY;

            // Hacer el cambio de frame más lento
            const scrollPerFrame = maxScrollTop / (totalFrames + 120); // Ajusta el divisor para hacer la animación más lenta (dividir el scroll por el número de frames - 1)

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
// Selecciona todos los elementos con la clase 'service-item'
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
// Seleccionamos el contenedor del mapa
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




// fijar navbar
$(document).ready(function () {
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
});


