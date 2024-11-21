<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* Navbar */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: white;
        padding: 10px 20px;
    }

    .navbar-brand:hover {
        color: #f1c6d4; /* Rosa clarito */
        transition: color 0.3s ease;
    }

    .form-inline {
    flex: 1;
    display: flex;
    justify-content: center;
    padding-left:200px;  /* Centramos el formulario en el contenedor */
}

.form-inline form {
    margin-left: 20px; /* Agregamos espacio a la izquierda del formulario */
    width: 100%;
    display: flex;
    align-items: center;
}

.form-inline input {
    width: 70%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
    transition: box-shadow 0.3s ease;
}

.form-inline input:focus {
    box-shadow: 0 0 8px rgba(255, 182, 193, 0.5); /* Rosa clarito */
}

.form-inline button {
    margin-left: 10px;
    padding: 10px 15px;
    background-color: #333; /* Fondo oscuro para el botón */
    border: none;
    border-radius: 20px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.form-inline button:hover {
    background-color: #f4d1db;
    color: #333;
    transform: scale(1.05);
}



    /* Iconos de navegación */
    .nav-icons {
        display: flex;
        align-items: center;
        margin-left: 20px;
    }

    .nav-icons a {
        color: #333;
        margin-left: 15px;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-icons a:hover {
        color: #f1c6d4; /* Rosa clarito */
    }

/* Navegación */
.navegacion {
    position: fixed;
    top: 60px;
    left: 0;
    right: 0;
    z-index: 999;
    display: flex;
    align-items: center;
    padding: 10px 0;
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    background-color: #fff;
    color: #333;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Contenedor de los elementos de navegación */
.navegacion-items-container {
    display: flex;
    gap: 30px;
    padding: 10px 0;
    align-items: center;
    overflow: hidden;
}

.navegacion-item {
    flex-shrink: 0;
    position: relative; /* Asegura que el dropdown se posicione correctamente */
    text-align: center;
    padding: 10px 20px;
    font-size: 18px;
    background-color: #f9f9f9;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Estilos para el dropdown */
.navegacion-item .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%; /* Aparece justo debajo del item */
    left: 0;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    z-index: 1001;
    border-radius: 8px;
    min-width: 300px;
    max-height: 400px; /* Limitar la altura para evitar que el dropdown salga de la pantalla */
    overflow-y: auto; /* Agregar scroll si es necesario */
}

/* Mostrar el dropdown al hacer hover o clic (si se ajusta con JS para clic) */
.navegacion-item:hover .dropdown-menu {
    display: block;
}

/* Botones de navegación */
.navegacion-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 1000;
    border-radius: 50%;
}

.navegacion-btn.left {
    left: 10px;
}

.navegacion-btn.right {
    right: 10px;
}

.navegacion-btn:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Estilos del Dropdown */
.dropdown-menu a {
    color: #333;
    text-decoration: none;
    display: block;
    padding: 8px 0;
    font-size: 14px;
}

.dropdown-menu a:hover {
    background-color: #f1f1f1;
}

/* Contenedor del dropdown */
.dropdown:hover > .dropdown-menu {
    display: block;
}

/* Ajustes para que los items no se superpongan */
.mega-menu .row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.mega-menu .col-md-3 {
    width: 200px;
}













    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .logo {
        width: auto;
        height: 60px;
    }

    /* Carrito de compras */
    .cart-sidebar {
    width: 400px;
    padding: 20px;
    background-color: #fff;
    position: fixed;
    right: -420px;
    top: 0;
    bottom: 0;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
    transition: right 0.3s ease;
    z-index: 1000;
}

.cart-sidebar.active {
    right: 0;
}

.close-btn {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #333;
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.cart-content {
    max-height: 60vh;
    overflow-y: auto;
}

/* General Cart Item Styles */
.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.cart-item:hover {
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
}

.product-image-container {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 8px;
    margin-right: 15px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-details {
    flex: 1;
    margin-left: 15px;
    display: flex;
    flex-direction: column;
}

.item-name {
    font-weight: bold;
    color: #333;
    font-size: 1.2em;
    margin-bottom: 5px;
}

.item-price-details {
    display: flex;
    flex-direction: column;
    font-size: 0.9em;
    color: #777;
    margin-top: 5px;
}

.item-quantity-price,
.item-total {
    color: #555;
}

.item-total {
    font-size: 1em;
    font-weight: bold;
    color: #e63946;
    margin-top: 5px;
}

/* Quantity Controls */
.quantity-controls {
    display: flex;
    align-items: center;
    margin-top: 5px;
}

.quantity-controls .btn-quantity {
    background-color: #f0f0f0;
    border: none;
    border-radius: 6px;
    width: 30px;
    height: 30px;
    font-size: 18px;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.quantity-controls .btn-quantity:hover {
    background-color: #ddd;
}

.quantity-controls input[type="number"] {
    width: 50px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 0 5px;
}

/* Remove Button */
.remove-btn {
    background-color: transparent;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 1.5rem;
    transition: color 0.3s;
}

.remove-btn:hover {
    color: #9a2323;
}

/* Empty Cart Message */
.empty-cart {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%; /* Para centrar verticalmente en todo el contenedor */
    text-align: center;
    padding: 20px;
    color: #999;
}

.empty-cart-icon {
    padding-top: 200px;
    font-size: 48px;
    color: #cccccc;
    margin-bottom: 10px;
}

.empty-cart-text {
    font-size: 18px;
    color: #666;
}


/* Total Price and Cart Footer */
.total-price {
    font-size: 1.4em;
    font-weight: bold;
    margin-top: 30px;
    text-align: center;
}

.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.checkout-btn {
    background-color: #333;
    border: none;
    color: #fff;
    padding: 10px 20px;
    font-size: 1.1em;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.checkout-btn:hover {
    background-color: #e63946;
}

.view-cart-btn {
    text-decoration: none;
    color: #e63946;
    font-weight: bold;
}

/* Sidebar */
.cart-sidebar.active .navegacion {
    display: none;
}

/* Ajax Message */
.mensaje-ajax {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: #333;
    color: #fff;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 16px;
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.4s ease;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(20px);
}

.mensaje-ajax.show {
    opacity: 1;
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .product-image-container {
        margin-bottom: 10px;
    }

    .cart-item-details {
        margin-left: 0;
    }
}

.padding-left{
    padding-left: 50px;
}


.login-btn {
    background-color: #333;
    color: white;
    padding: 10px 20px; /* Tamaño del botón */
    border: 2px solid #333; /* Borde para darle definición */
    border-radius: 5px; /* Esquinas redondeadas */
    font-size: 16px; /* Tamaño del texto */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
    transition: all 0.3s ease; /* Transición suave para todos los cambios */
}

.login-btn:hover {
    background-color: #f0c4d0;
    color: #333;
    border-color: #f0c4d0; /* Cambia el color del borde al pasar el mouse */
    transform: scale(1.05); /* Un pequeño efecto de zoom */
}


</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 10px;">
    <div class="container-fluid">
        <!-- Botón sidebar (icono) -->
        <button class="btn btn-outline-primary me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" style="display: flex; align-items: center;">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
            <img class="logo img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo">

        </a>

        <!-- Barra de búsqueda -->
        <form action="{{ route('buscar') }}" method="GET" style="flex-grow: 1; margin-left: 20px; display: flex; align-items: center;">
            <input type="text" name="query" placeholder="Buscar productos..." required style="flex-grow: 1; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Buscar</button>
        </form>

        <!-- Icono del carrito -->
        <a href="#" id="cart-icon" style="margin-left: 20px; text-decoration: none; color: inherit; display: flex; align-items: center;">
            <span id="cart-icon-total" style="margin-right: 5px;">$0.00</span>
            <i class="fas fa-shopping-cart"></i>
        </a>

        <!-- Avatar o sesión -->
        <div class="dropdown ms-3" style="display: flex; align-items: center;">
            @if(auth()->check())
                <a href="#" id="navbarDropdownMenuAvatar" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a></li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar sesión</a>
            @endif
        </div>







   <!-- Icono del carrito -->
<div class="nav-icons">
    <a href="#" id="cart-icon">
        <span id="cart-icon-total">$0.00</span> <i class="fas fa-shopping-cart"></i>
    </a>
</div>

<!-- Sidebar para el carrito -->
<div id="cart-sidebar" class="cart-sidebar">
    <div class="cart-header">
        <h3>Mi Carrito</h3>
        <button id="close-sidebar" class="close-btn">X</button>
    </div>
    <div class="cart-content"></div>
    <div class="cart-footer">
        <!-- Subtotal Display en el Sidebar -->
        <div class="cart-subtotal">
            <p id="cart-total-sidebar" class="subtotal-text">Total: $0.00</p>
        </div>

        <a href="{{ route('checkout') }}" class="btn btn-primary checkout-btn">Finalizar compra</a>
    </div>


</div>
            <!-- Avatar -->
            <div class="dropdown padding-left">
                @if(auth()->check())
                    <a
                        data-mdb-dropdown-init
                        class="dropdown-toggle d-flex align-items-center hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuAvatar"
                        role="button"
                        aria-expanded="false"
                    >
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            class="rounded-circle"
                            height="64"
                            width="64"
                            alt="{{ auth()->user()->username }}"
                            loading="lazy"
                        />
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuAvatar"
                    >
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="btn login-btn">
                        Iniciar Sesion
                    </a>
                @endif
            </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="width: 300px; background-color: #f8f9fa;">
    <div class="offcanvas-header" style="padding: 15px; border-bottom: 1px solid #e0e0e0;">
        <h5 id="sidebarMenuLabel" style="margin: 0; font-size: 1.25rem; font-weight: bold; color: #333;">Categorías</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="padding: 15px;">
        <!-- Lista de Categorías -->
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach ($categorias as $categoria)
                <li style="margin-bottom: 10px;">
                    <!-- Categoría como toggle -->
                    <a class="d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse"
                       href="#collapse-{{ $categoria->id }}"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapse-{{ $categoria->id }}"
                       style="text-decoration: none; font-weight: bold; color: #333; padding: 10px 15px; border-radius: 5px; transition: background-color 0.3s; cursor: pointer;"
                       onmouseover="this.style.backgroundColor='#e0e0e0';"
                       onmouseout="this.style.backgroundColor='transparent';">
                        {{ $categoria->nombre }}
                        <span>&#9662;</span> <!-- Flecha -->
                    </a>

                    <!-- Subcategorías -->
                    @if ($categoria->subcategorias->isNotEmpty())
                        <div class="collapse" id="collapse-{{ $categoria->id }}" style="margin-top: 5px;">
                            <ul style="list-style: none; padding-left: 20px; margin: 0;">
                                @foreach ($categoria->subcategorias as $subcategoria)
                                    <li style="margin-bottom: 5px;">
                                        <a href="#"
                                           style="display: block; text-decoration: none; color: #555; padding: 8px 12px; border-radius: 4px; transition: background-color 0.3s; cursor: pointer;"
                                           onmouseover="this.style.backgroundColor='#e0f7fa';"
                                           onmouseout="this.style.backgroundColor='transparent';">
                                            {{ $subcategoria->nombre }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>






<script>





    document.addEventListener('DOMContentLoaded', function () {
        // Actualizar el subtotal al cargar la página
        actualizarTotalCarrito();

        // Abrir el carrito al hacer clic en el ícono
        document.getElementById('cart-icon').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('cart-sidebar').classList.add('active');
            cargarContenidoCarrito();
        });

        // Cerrar el sidebar del carrito al hacer clic en el botón "X"
        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.remove('active');
        });
    });

    function cargarContenidoCarrito() {
    fetch('/carrito/contenido')
        .then(response => response.json())
        .then(data => {
            let cartContent = document.querySelector('.cart-content');
            cartContent.innerHTML = '';

            if (data.carrito && Object.keys(data.carrito).length > 0) {
                let subtotal = 0;

                Object.entries(data.carrito).forEach(([id, product]) => {
                    let totalPorProducto = product.precio * product.cantidad;
                    subtotal += totalPorProducto;

                    cartContent.innerHTML += `
<div class="cart-item">
    <div class="product-image-container">
        <img
            src="${product.main_photo || '/ruta/a/imagen-placeholder.jpg'}"
            alt="${product.nombre}"
            class="img-fluid rounded shadow mb-4"
            onerror="this.src='/ruta/a/imagen-placeholder.jpg'; this.alt='Imagen no disponible';"
        >
    </div>

    <div class="cart-item-details">
        <span class="item-name">${product.nombre}</span>
        <div class="item-price-details">
            <span class="item-quantity">Cantidad: ${product.cantidad}</span>
            <span class="item-price">Precio unitario: $${product.precio}</span>
            <span class="item-total" id="product-total-${id}">Total: $${totalPorProducto.toFixed(2)}</span>
        </div>
    </div>

    <button class="remove-btn" onclick="removeFromCart(${id})">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>

`;

                });

                // Actualizar los totales del carrito
                actualizarTotalesCarrito(subtotal);
            } else {
                mostrarCarritoVacio(cartContent);
            }
        })
        .catch(error => console.error('Error al cargar el contenido del carrito:', error));
}

function actualizarTotalCarrito() {
    fetch('/carrito/contenido')
        .then(response => response.json())
        .then(data => {
            const cartFooter = document.querySelector('.cart-footer');
            if (data.carrito && Object.keys(data.carrito).length > 0) {
                // Calcular el subtotal
                let subtotal = 0;
                Object.entries(data.carrito).forEach(([id, product]) => {
                    subtotal += product.precio * product.cantidad;
                });

                // Actualizar el total
                actualizarTotalesCarrito(subtotal);

                // Mostrar el cart-footer cuando hay productos en el carrito
                cartFooter.style.display = 'flex';
            } else {
                // Si el carrito está vacío, asegurarse de que el total sea 0
                actualizarTotalesCarrito(0);

                // Ocultar el cart-footer cuando el carrito esté vacío
                cartFooter.style.display = 'none';
            }
        })
        .catch(error => console.error('Error al actualizar el total del carrito:', error));
}

// Función para actualizar los totales en el carrito
function actualizarTotalesCarrito(total) {
    document.getElementById('cart-total-sidebar').innerText = `Total: $${total.toFixed(2)}`;
    document.getElementById('cart-icon-total').innerText = `$${total.toFixed(2)}`;
}

function actualizarTotalesCarrito(subtotal) {
    document.getElementById('cart-icon-total').innerText = `$${subtotal.toFixed(2)}`;
    document.getElementById('cart-total-sidebar').innerText = `Total: $${subtotal.toFixed(2)}`;
}





function removeFromCart(productId) {
    fetch(`/carrito/${productId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (response.ok) {
            cargarContenidoCarrito(); // Actualizar la vista del carrito
        } else {
            console.error('Error al eliminar el producto del carrito');
        }
    })
    .catch(error => console.error('Error al eliminar el producto del carrito:', error));
}


function mostrarCarritoVacio(cartContent) {
    cartContent.innerHTML = `
        <div class="empty-cart">
            <i class="fas fa-shopping-cart empty-cart-icon"></i>
            <p class="empty-cart-text">Tu carrito está vacío.</p>
        </div>
    `;
    document.getElementById('cart-icon-total').innerText = '$0.00';
    document.getElementById('cart-total-sidebar').innerText = 'Total: $0.00';

    // Oculta el contenedor del subtotal y botón de compra
    document.querySelector('.cart-footer').style.display = 'none';
}



    function mostrarMensajeEliminacion(mensaje) {
    const mensajeElemento = document.createElement('div');
    mensajeElemento.textContent = mensaje;
    mensajeElemento.className = 'mensaje-ajax';

    document.body.appendChild(mensajeElemento);

    // Mostrar el mensaje
    setTimeout(() => {
        mensajeElemento.classList.add('show');
    }, 100); // Le damos un pequeño delay para que se aplique la animación

    // Eliminar el mensaje después de 3 segundos
    setTimeout(() => {
        mensajeElemento.remove();
    }, 3000);
}


function removeFromCart(productId) {
    fetch(`/carrito/${productId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (response.ok) {
            cargarContenidoCarrito(); // Actualizar la vista del carrito
            actualizarTotalCarrito(); // Actualizar el subtotal
            mostrarMensajeEliminacion('Producto eliminado del carrito');
        } else {
            console.error('Error al eliminar el producto del carrito');
        }
    })
    .catch(error => console.error('Error al eliminar el producto del carrito:', error));
}


    </script>
