<!-- Contenedor con margen y espaciado -->
<div class="container my-5">
    <h2 class="mb-4 text-center" style="font-family: 'Pacifico', cursive; color: #0D1E4C; letter-spacing: 5px;">Preguntas Frecuentes</h2>
    <div class="accordion" id="faqAccordion">

        <!-- Pregunta 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button flat-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    ¿Como me puedo inscribir a un curso?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tienes que acudir a la academia y ahi un administrador o profesor te inscribiria a tu curso. En caso de que no tengas cuenta se te registrara una nueva.
                </div>
            </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button flat-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    ¿Como se maneja las inscripciones y colegiaturas?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    La inscripciones una vez de por vida y las colegiaturas se hace cada semana. Solo pagas inscripcion la primera vez.
                </div>
            </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button flat-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    ¿Horario de la academia?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    8:00 a 20:00 horas de lunes a sabado, el domingo de 10:00 a 18:00.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos mejorados para el acordeón -->
<style>
    /* Estilo general para el contenedor del acordeón */
    .accordion {
        border: none;
        border-radius: 10px;
        background-color: #f8f9fa;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .accordion-button {
        background-color: #0D1E4C;
        color: white;
        font-size: 1.2rem;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        letter-spacing: 2px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Cambiar color al hacer hover */
    .accordion-button:hover {
        background-color: #1e3a8a;
        transform: scale(1.05);
    }

    /* Estilo de las respuestas cuando se muestran */
    .accordion-body {
        font-size: 1rem;
        font-family: 'Arial', sans-serif;
        color: #555;
        background-color: #f1f3f5;
        padding: 15px;
        border-radius: 8px;
        border-top: 1px solid #ddd;
        transition: padding 0.3s ease, background-color 0.3s ease;
    }

    /* Transición suave para abrir y cerrar */
    .accordion-collapse {
        transition: height 0.5s ease;
    }

    /* Cambiar el color del botón cuando está colapsado */
    .accordion-button.collapsed {
        background-color: #0D1E4C;
        color: white;
    }

    /* Diseño de las cabeceras del acordeón */
    .accordion-header {
        padding: 0;
    }

    /* Ajustes adicionales para mejorar la estética */
    .accordion-item {
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>


