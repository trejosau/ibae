@extends('layouts.app')

@section('title', 'Salon')

@section('content')

<style>
    .contenedor{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .button{
        text-align: center;

    }

</style>

    <main>
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('images/table-stylist-studio.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg')}}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>


        <div class=" contenedor row">
                    <div>
                        <img class="img-fluid pt-4 pb-4" src="{{asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg')}}" alt="">
                    </div>

                    <div class=" justify-content-center">
                        <h2 class="fs-2 pt-4">Salon Ibae</h2>
                        <p class="fs-4 pb-4 pt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem eius deleniti recusandae ipsa, quam pariatur optio deserunt tenetur tempore at veritatis dolor dolore, repudiandae laborum aperiam blanditiis corporis? Sapiente, cupiditate!</p>

                        <div class="button">
                        <a href="#" class="btn btn-primary ">Reservar una Cita</a>
                        </div>
                    </div>
        </div>

    </main>
@endsection
