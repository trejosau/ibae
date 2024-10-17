@extends('layouts.app')

@section('content')
<style>
    /* Opcional: ajusta el estilo del texto y espaciado */
    .category-menu a {
      color: black;
      text-decoration: none;
      padding: 10px;
    }

    .category-menu a:hover {
      color: red;
    }

    .category-content {
      display: flex;
      margin-top: 20px;
    }

    .category-image {
      margin-left: 50px;
    }

    .category-content img {
      max-width: 100%;
      border-radius: 10px;
    }
</style>

<!-- Menú de categorías con accordion -->
<div class="accordion" id="categoryAccordion">
  <nav class="category-menu">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#tintes" aria-expanded="false" aria-controls="tintes">Tintes</a>
    <a href="#" data-bs-toggle="collapse" data-bs-target="#cabello" aria-expanded="false" aria-controls="cabello">Cabello</a>
    <a href="#" data-bs-toggle="collapse" data-bs-target="#barberia" aria-expanded="false" aria-controls="barberia">Barbería</a>
    <a href="#" data-bs-toggle="collapse" data-bs-target="#maquillaje" aria-expanded="false" aria-controls="maquillaje">Maquillaje</a>
    <!-- Agrega más categorías si es necesario -->
  </nav>

  <!-- Contenido que se despliega al hacer clic en una categoría -->
  <div id="tintes" class="accordion-collapse collapse category-content" data-bs-parent="#categoryAccordion">
    <div class="category-text">
        <h3>TINTES</h3>
        <ul>
            <li><a href="#">Tintes Permanentes</a></li>
            <li><a href="#">Tintes temporales y fantasía</a></li>
            <li><a href="#">Peróxido, decolorantes y aditivos</a></li>
            <li><a href="#">Accesorios para teñir</a></li>
            <li><a href="#">Cobertura de canas</a></li>
            <li><a href="#">Depositadores de color</a></li>
        </ul>
    </div>
</div>

<div id="cabello" class="accordion-collapse collapse category-content" data-bs-parent="#categoryAccordion">
    <div class="category-text">
        <h3>CABELLO</h3>
        <ul>
            <li><a href="#">Shampoo y acondicionador</a></li>
            <li><a href="#">Tratamientos capilares</a></li>
            <li><a href="#">Mascarillas para el cabello</a></li>
            <li><a href="#">Sérum y aceites</a></li>
            <li><a href="#">Cepillos y peines</a></li>
        </ul>
    </div>
</div>

<div id="barberia" class="accordion-collapse collapse category-content" data-bs-parent="#categoryAccordion">
    <div class="category-text">
        <h3>BARBERÍA</h3>
        <ul>
            <li><a href="#">Máquinas de cortar cabello</a></li>
            <li><a href="#">Ceras y pomadas</a></li>
            <li><a href="#">Tijeras de peluquería</a></li>
            <li><a href="#">Afeitado clásico</a></li>
            <li><a href="#">Aftershave y lociones</a></li>
        </ul>
    </div>
</div>

<div id="maquillaje" class="accordion-collapse collapse category-content" data-bs-parent="#categoryAccordion">
    <div class="category-text">
        <h3>MAQUILLAJE</h3>
        <ul>
            <li><a href="#">Bases y correctores</a></li>
            <li><a href="#">Sombras y delineadores</a></li>
            <li><a href="#">Labiales y bálsamos</a></li>
            <li><a href="#">Rubores y polvos</a></li>
            <li><a href="#">Máscaras para pestañas</a></li>
        </ul>
    </div>
</div>

<div id="herramientas" class="accordion-collapse collapse category-content" data-bs-parent="#categoryAccordion">
    <div class="category-text">
        <h3>HERRAMIENTAS</h3>
        <ul>
            <li><a href="#">Secadoras de cabello</a></li>
            <li><a href="#">Plancha de cabello</a></li>
            <li><a href="#">Rizadores</a></li>
            <li><a href="#">Cepillos térmicos</a></li>
            <li><a href="#">Pinzas y ganchos</a></li>
        </ul>
    </div>
</div>


@endsection
