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
import interactionPlugin from '@fullcalendar/interaction'; // para la interacción

import ApexCharts from 'apexcharts';







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

    if (window.location.pathname === '/dashboard/inicio') {


// Opciones del gráfico con tus datos de ingresos
        var options = {
            series: [
                {
                    name: 'Academia',
                    data: [
                        [new Date('2020-04-01').getTime(), 5000],
                        [new Date('2020-05-01').getTime(), 25000],  // Pico fuerte en marzo 2020
                        [new Date('2020-06-01').getTime(), 500],    // Caída fuerte en junio 2020
                        [new Date('2020-09-01').getTime(), 30000],  // Subida brutal en septiembre 2020
                        [new Date('2021-02-01').getTime(), 2000],
                        [new Date('2021-05-01').getTime(), 35000],  // Pico enorme en mayo 2021
                        [new Date('2021-08-01').getTime(), 400],    // Caída dramática en agosto 2021
                        [new Date('2022-01-01').getTime(), 27000],  // Pico en enero 2022
                        [new Date('2022-04-01').getTime(), 1500],
                        [new Date('2022-10-01').getTime(), 45000],  // Máximo impresionante en octubre 2022
                        [new Date('2023-03-01').getTime(), 300],    // Caída extrema en marzo 2023
                        [new Date('2023-09-01').getTime(), 32000],  // Recuperación en septiembre 2023
                        [new Date('2024-02-01').getTime(), 50000]   // Subida masiva en abril 2024
                    ]
                },
                {
                    name: 'Salón',
                    data: [
                        [new Date('2020-04-01').getTime(), 15000],  // Pico inicial en febrero 2020
                        [new Date('2020-05-01').getTime(), 1000],   // Caída en mayo 2020
                        [new Date('2020-10-01').getTime(), 40000],  // Pico extremo en octubre 2020
                        [new Date('2021-01-01').getTime(), 2000],
                        [new Date('2021-06-01').getTime(), 28000],  // Fuerte subida en junio 2021
                        [new Date('2021-11-01').getTime(), 600],    // Caída grande en noviembre 2021
                        [new Date('2022-03-01').getTime(), 35000],  // Recuperación en marzo 2022
                        [new Date('2022-07-01').getTime(), 2500],
                        [new Date('2023-01-01').getTime(), 42000],  // Pico muy alto en enero 2023
                        [new Date('2023-06-01').getTime(), 700],    // Caída extrema en junio 2023
                        [new Date('2023-12-01').getTime(), 30000],  // Pico en diciembre 2023
                        [new Date('2024-02-01').getTime(), 2000]
                    ]
                },
                {
                    name: 'Tienda',
                    data: [
                        [new Date('2020-04-01').getTime(), 35000],  // Gran pico en abril 2020
                        [new Date('2020-07-01').getTime(), 500],    // Caída fuerte en julio 2020
                        [new Date('2020-12-01').getTime(), 48000],  // Pico enorme en diciembre 2020
                        [new Date('2021-04-01').getTime(), 3000],
                        [new Date('2021-09-01').getTime(), 55000],  // Máximo en septiembre 2021
                        [new Date('2022-02-01').getTime(), 800],    // Caída muy fuerte en febrero 2022
                        [new Date('2022-08-01').getTime(), 60000],  // Gran subida en agosto 2022
                        [new Date('2022-11-01').getTime(), 1000],
                        [new Date('2023-05-01').getTime(), 70000],  // Pico brutal en mayo 2023
                        [new Date('2023-10-01').getTime(), 500],    // Caída muy baja en octubre 2023
                        [new Date('2024-01-01').getTime(), 80000],  // Máximo impresionante en enero 2024
                        [new Date('2024-02-01').getTime(), 1000]    // Caída final en febrero 2024
                    ]
                }
            ]
            ,

            chart: {
                type: 'area',
                height: 350,
                stacked: true,
                events: {
                    selection: function (chart, e) {
                        console.log(new Date(e.xaxis.min));
                    }
                }
            },
            colors: ['#008FFB', '#00E396', '#CED4DC'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'monotoneCubic'
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
                type: 'datetime'
            }
        };

// Renderizar el gráfico en el contenedor con id 'chart'
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    }

    if (window.location.pathname === '/dashboard/ventas') {

            // Aquí puedes colocar los datos de las fechas y valores
        var dates = [
            ['2020-01-01', 150],
            ['2020-02-01', 120],
            ['2020-03-01', 130],
            ['2020-04-01', 160],
            ['2020-05-01', 200],
            ['2020-06-01', 300],  // Pico por inicio del verano
            ['2020-07-01', 350],  // Pico de verano
            ['2020-08-01', 250],
            ['2020-09-01', 180],
            ['2020-10-01', 160],
            ['2020-11-01', 220],
            ['2020-12-01', 400],  // Pico por temporada navideña
            ['2021-01-01', 180],
            ['2021-02-01', 130],
            ['2021-03-01', 140],
            ['2021-04-01', 170],
            ['2021-05-01', 210],
            ['2021-06-01', 320],  // Pico por inicio del verano
            ['2021-07-01', 370],  // Pico de verano
            ['2021-08-01', 260],
            ['2021-09-01', 190],
            ['2021-10-01', 170],
            ['2021-11-01', 230],
            ['2021-12-01', 450],  // Pico por temporada navideña
            ['2022-01-01', 190],
            ['2022-02-01', 140],
            ['2022-03-01', 150],
            ['2022-04-01', 180],
            ['2022-05-01', 220],
            ['2022-06-01', 330],  // Pico por inicio del verano
            ['2022-07-01', 380],  // Pico de verano
            ['2022-08-01', 280],
            ['2022-09-01', 200],
            ['2022-10-01', 180],
            ['2022-11-01', 240],
            ['2022-12-01', 470],  // Pico por temporada navideña
            ['2023-01-01', 200],
            ['2023-02-01', 150],
            ['2023-03-01', 160],
            ['2023-04-01', 190],
            ['2023-05-01', 230],
            ['2023-06-01', 340],  // Pico por inicio del verano
            ['2023-07-01', 390],  // Pico de verano
            ['2023-08-01', 290],
            ['2023-09-01', 210],
            ['2023-10-01', 190],
            ['2023-11-01', 250],
            ['2023-12-01', 500],  // Pico por temporada navideña
            ['2024-01-01', 210],
            ['2024-02-01', 160],
            ['2024-03-01', 170],
            ['2024-04-01', 200],
            ['2024-05-01', 240],
            ['2024-06-01', 350],  // Pico por inicio del verano
            ['2024-07-01', 400],  // Pico de verano
            ['2024-08-01', 300],
            ['2024-09-01', 220],
            ['2024-10-01', 200],
            ['2024-11-01', 260],
            ['2024-12-01', 520]   // Pico por temporada navideña
        ];



        var options = {
            series: [{
                name: 'IBA&E',
                data: dates
            }],
            chart: {
                type: 'area',
                stacked: false,
                height: 350,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                toolbar: {
                    autoSelected: 'zoom'
                }
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                },
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return (val / 1000000).toFixed(0);
                    },
                },
                title: {
                    text: 'Price'
                },
            },
            xaxis: {
                type: 'datetime',
            },
            tooltip: {
                shared: false,
                y: {
                    formatter: function (val) {
                        return val.toFixed(2); // Ajusta los decimales en el tooltip
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }


    if (window.location.pathname === '/dashboard/compras') {

        // Variables de configuración
        var numProductos = 30; // Ajusta el número de productos
        var maxStock = 90;     // Máximo stock aleatorio para las barras
        var alturaBarra = 20;   // Altura de cada barra en píxeles

        // Generación dinámica de productos y datos
        var categories = Array.from({ length: numProductos }, (_, i) => 'Producto ' + (i + 1));
        var data = Array.from({ length: numProductos }, () => Math.floor(Math.random() * maxStock)); // Datos aleatorios

        // Configuración del gráfico
        var options = {
            series: [{
                name: 'Stock',  // Nombre personalizado para la serie
                data: data
            }],
            chart: {
                type: 'bar',
                height: numProductos * alturaBarra + 'px', // Ajuste automático de altura
                toolbar: {
                    show: true,  // Mostrar herramientas del gráfico
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: alturaBarra + 'px', // Altura fija de las barras
                    distributed: true,             // Colores variados para las barras
                }
            },
            xaxis: {
                categories: categories, // Nombres de los productos
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val;  // Mostrar "Stock: [valor]" en el tooltip
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '12px', // Tamaño de fuente para los nombres de los productos
                    }
                }
            },
            grid: {
                show: true,  // Mostrar la cuadrícula de fondo
            },
            dataLabels: {
                enabled: false // No mostrar etiquetas dentro de las barras
            },
            legend: {
                show: false // Ocultar leyenda de colores
            }
        };

        // Renderizar el gráfico
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }



    if (window.location.pathname === '/dashboard/citas') {
        // Datos de ejemplo para las citas
        const categorias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        const citas = [12, 8, 15, 10, 18, 20, 5];

        // Configuración del gráfico
        const opciones = {
            series: [{
                name: 'Citas',
                data: citas
            }],
            chart: {
                type: 'line', // Cambiar a gráfico de líneas
                height: '350px',
                toolbar: {
                    show: true,
                }
            },
            xaxis: {
                categories: categorias, // Días de la semana
            },
            yaxis: {
                title: {
                    text: 'Número de Citas'
                }
            },
            title: {
                text: 'Citas por Día en el Salón de Belleza',
                align: 'center'
            },
            dataLabels: {
                enabled: true // Habilita las etiquetas de datos
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + ' citas'; // Muestra "X citas" en el tooltip
                    }
                }
            },
            stroke: {
                curve: 'smooth' // Hace que la línea sea suave
            }
        };

        // Renderizar el gráfico
        const chart = new ApexCharts(document.querySelector("#chart"), opciones);
        chart.render();



    }




});
