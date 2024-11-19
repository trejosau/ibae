import './bootstrap';
import 'bootstrap';
import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";
initMDB({ Dropdown, Collapse });
import $ from 'jquery';
import '@splidejs/splide/css';
import '@splidejs/splide/css/skyblue';
import '@splidejs/splide/css/sea-green';
import '@splidejs/splide/css/core';
import '@popperjs/core';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import 'lightbox2/dist/js/lightbox.min.js';
import ApexCharts from 'apexcharts';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();










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

    if (window.location.pathname.startsWith('/dashboard/') || window.location.pathname.startsWith('/plataforma/')) {
        const toggleBtns = document.querySelectorAll(".toggle-btn");

        toggleBtns.forEach((elemento) => {
            const iconOpen = elemento.querySelector(".bi-grid-1x2"); // Icono cuando el sidebar está cerrado
            const iconClose = elemento.querySelector(".bi-grid-1x2-fill"); // Icono cuando el sidebar está abierto

            // Evento para alternar la expansión del sidebar
            elemento.addEventListener("click", function () {
                const sidebar = elemento.closest('aside'); // Encuentra el sidebar padre
                sidebar.classList.toggle("expand");

                // Alternar iconos
                if (sidebar.classList.contains("expand")) {
                    iconOpen.classList.add("hidden");
                    iconClose.classList.remove("hidden");
                } else {
                    iconOpen.classList.remove("hidden");
                    iconClose.classList.add("hidden");
                }
            });
        });

        // Función para actualizar la fecha y hora
        function actualizarFechaHora() {
            const hoy = new Date();
            const dia = String(hoy.getDate()).padStart(2, '0');
            const mes = String(hoy.getMonth() + 1).padStart(2, '0'); // Los meses comienzan en 0
            const anio = hoy.getFullYear();
            const horas = String(hoy.getHours()).padStart(2, '0');
            const minutos = String(hoy.getMinutes()).padStart(2, '0');
            const segundos = String(hoy.getSeconds()).padStart(2, '0');

            document.querySelectorAll('#fecha-hora').forEach((element) => {
                element.textContent = `${dia}/${mes}/${anio} ${horas}:${minutos}:${segundos}`;
            });
        }

        // Llama a la función de actualización de fecha y hora cada segundo
        setInterval(actualizarFechaHora, 1000);
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










    if (window.location.pathname === '/dashboard/inicio') {

        // Función para formatear los datos en el formato [fecha, total] para ApexCharts
        function formatDataForChart(dataArray) {
            return dataArray.map(item => {
                const date = new Date(new Date().getFullYear(), item.Mes - 1, 1); // Primer día del mes
                return [date.getTime(), item.Total];
            });
        }

        // Realizar la solicitud AJAX a la ruta /graficas/data
        fetch('/graficas/data')
            .then(response => response.json())
            .then(data => {
                // Formatear los datos de cada categoría para el gráfico
                const academiaData = formatDataForChart(data.academia);
                const salonData = formatDataForChart(data.salon);
                const ventasData = formatDataForChart(data.ventas);

                // Configuración del gráfico ApexCharts
                var options = {
                    series: [
                        {
                            name: 'Academia',
                            data: academiaData
                        },
                        {
                            name: 'Salón',
                            data: salonData
                        },
                        {
                            name: 'Tienda',
                            data: ventasData
                        }
                    ],
                    chart: {
                        locales: [{
                            "name": "es",
                            "options": {
                                "months": ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                "shortMonths": ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                                "days": ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                                "shortDays": ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                                "toolbar": {
                                    "exportToSVG": "Descargar SVG",
                                    "exportToPNG": "Descargar PNG",
                                    "menu": "Menú",
                                    "selection": "Selección",
                                    "selectionZoom": "Zoom de Selección",
                                    "zoomIn": "Acercar",
                                    "zoomOut": "Alejar",
                                    "pan": "Desplazar",
                                    "reset": "Restablecer Zoom"
                                }
                            }
                        }],
                        defaultLocale: "es",
                        type: 'line',
                        height: 350,
                        stacked: false
                    },
                    colors: ['#008FFB', '#00E396', '#CED4DC'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            opacityFrom: 0.6,
                            opacityTo: 0.8
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left'
                    },
                        xaxis: {
                            type: 'datetime',
                            labels: {
                                format: 'MMM'
                            },
                            title: {
                                text: 'Meses del Año'
                            }
                        },
                    yaxis: {
                        tickAmount: 8,
                        labels: {
                            formatter: function(value) {
                                return `$${value.toLocaleString()}`;
                            }
                        },
                        title: {
                            text: 'Cantidad Total'
                        }
                    },

                    tooltip: {
                        x: {
                            format: 'MMMM' // Muestra el nombre completo del mes en el tooltip
                        },
                        y: {
                            formatter: function(value) {
                                return `$${value.toLocaleString()}`; // Formato con símbolo de moneda y separadores
                            }
                        }
                    }
                };

                // Renderizar el gráfico en el contenedor con id 'chart'
                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    }

});
