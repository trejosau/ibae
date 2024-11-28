<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
        /* Paleta de colores */
        :root {
            --color-fondo: #F8F9FA; /* Gris claro para fondo principal */
            --color-primario: #0D1E4C; /* Azul oscuro */
            --color-secundario: #83A6CE; /* Azul claro */
            --color-acento: #C48CB3; /* Rosa oscuro */
            --color-texto: #26415E; /* Azul medio */
            --color-footer: #0B1B32; /* Azul noche */
        }
        .navbar {
            background: linear-gradient(90deg, var(--color-primario), var(--color-acento));
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            margin-left: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }
.logo {
    width: auto;
    height: 60px;
}
.navbar {
    position: fixed;
    top: 0;
     left: 0;
    right: 0;
    z-index: 1000;
    background-color: white;
    padding: 10px 20px;
}


    /* Iconos de navegación */
.nav-icons {
    background-color: #333;
    color: white;
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.nav-icons:hover {
    background-color: #f1c6d4;
    color: #333;
}

/* Carrito de compras */

.btn-cart {
    color: #333;
    display: flex;
    align-items: center;
}

.btn-cart:hover {
    color: #f1c6d4;
}


.btn-cart:hover i, /* El carrito */
.btn-cart:hover #cart-icon-total { /* El total */
    color: #f1c6d4;
}



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

/* Remove Button */
.remove-btn {
    background-color: transparent;
    border: none;
    color: #333;
    cursor: pointer;
    font-size: 1.5rem;
    transition: color 0.3s;
}

.remove-btn:hover {
    color: #ff0000;
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
    background-color: #f1c6d4;
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
<nav class="navbar navbar-expand-lg" style="padding: 10px;">
    <div class="container-fluid">

        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>

        <div style="display: flex; align-items: center; margin-right: 24px">
            <!-- Enlace al catálogo -->
            <a href="/catalogo" class="btn " style="margin-left: 20px; text-decoration: none; color: inherit;">Catálogo</a>

            <!-- Enlace a mis pedidos -->
            @if(auth()->check())
                <a href="/pedidos" class="btn " style="margin-left: 20px; text-decoration: none; color: inherit;">Mis Pedidos</a>
            @endif

            <!-- Icono del carrito -->
            <a class="btn-cart" href="#" id="cart-icon" style="margin-left: 20px; text-decoration: none; color: inherit; display: flex; align-items: center;">
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
                    <a href="{{ route('login') }}" class="btn nav-icons">Iniciar sesión</a>
                @endif
            </div>
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

    </div>
</nav>







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
