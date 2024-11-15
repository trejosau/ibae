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
        text-align: center;
        padding: 20px 0;
        display: flex;
        justify-content: center;
        gap: 30px;
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        background-color: #fff;
    }

    .navegacion a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
        padding: 10px;
        position: relative;
        transition: color 0.3s ease;
    }

    .navegacion a:hover {
        color: #f1c6d4; /* Rosa clarito */
    }

    .navegacion-item {
        position: relative;
    }

    .mega-menu {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        padding: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 8px;
        width: auto;
        white-space: nowrap;
        overflow: visible;
    }

    .mega-menu .container-fluid {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .mega-menu .col-md-4,
    .mega-menu .col-md-3,
    .mega-menu .col-md-2,
    .mega-menu .col-md-5 {
        flex: 1;
        box-sizing: border-box;
        padding: 10px;
        margin-right: 10px;
        border-right: 1px dashed #ccc;
        min-width: 180px;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        background-color: #ffeef8; /* Rosa clarito */
    }

    .mega-menu .col-md-4:last-child,
    .mega-menu .col-md-3:last-child,
    .mega-menu .col-md-2:last-child,
    .mega-menu .col-md-5:last-child {
        border-right: none;
        margin-right: 0;
    }

    .mega-menu h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        background-color: #f0c4d0; /* Rosa clarito */
        padding: 5px;
        border-radius: 4px;
        color: #333;
    }

    .mega-menu a {
        display: block;
        margin-bottom: 5px;
        padding: 5px;
        color: #555;
        transition: background-color 0.3s ease;
        border-radius: 3px;
        position: relative;
    }

    .mega-menu a:before {
        content: "•";
        color: #e63946; /* Rojo */
        margin-right: 5px;
    }

    .mega-menu a:hover {
        background-color: #f0e1e5; /* Rosa más claro */
    }

    .navegacion-item:hover .mega-menu {
        display: block;
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

<nav class="navbar navbar-expand-lg p-0">
    <div class="container p-0">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
        </a>


        <div class="form-inline">
            <form action="{{ route('buscar') }}" method="GET" class="d-flex align-items-center w-100">
                <input type="text" name="query" class="search-input" placeholder="Buscar productos..." required>
                <button type="submit" class="btn btn-primary ml-2">Buscar</button>
            </form>
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

<nav class="navegacion">

    <div class="navegacion-item">
        <a href="#">Tintes</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-4">
                    <h3>TINTES</h3>
                    <a href="#">Tintes Permanentes</a>
                    <a href="#">Tintes Temporales</a>
                    <a href="#">Tintes Orgánicos</a>
                    <a href="#">Tintes Sin Amoniaco</a>
                </div>
                <div class="col-md-4">
                    <h3>Productos Relacionados</h3>
                    <a href="#">Shampoo para tintes</a>
                    <a href="#">Acondicionadores</a>
                    <a href="#">Tratamientos Post-Tinte</a>
                    <a href="#">Protección del Color</a>
                </div>
                <div class="col-md-4">
                    <h3>Accesorios</h3>
                    <a href="#">Accesorios para teñir</a>
                    <a href="#">Peróxido</a>
                    <a href="#">Decolorantes</a>
                    <a href="#">Pinceles y Bowls</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Cabello</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-3">
                    <h3>CABELLO</h3>
                    <a href="#">Shampoo y Acondicionador</a>
                    <a href="#">Tratamientos capilares</a>
                    <a href="#">Cuidado del cuero cabelludo</a>
                </div>
                <div class="col-md-3">
                    <h3>Estilo</h3>
                    <a href="#">Geles y ceras</a>
                    <a href="#">Lacas</a>
                    <a href="#">Pomadas</a>
                </div>
                <div class="col-md-3">
                    <h3>Secado</h3>
                    <a href="#">Secadoras de cabello</a>
                    <a href="#">Difusores</a>
                </div>
                <div class="col-md-3">
                    <h3>Accesorios</h3>
                    <a href="#">Planchas</a>
                    <a href="#">Rizadores</a>
                    <a href="#">Peines</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Barbería</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-4">
                    <h3>BARBERÍA</h3>
                    <a href="#">Cortes</a>
                    <a href="#">Rasuradoras</a>
                    <a href="#">Navajas</a>
                </div>
                <div class="col-md-4">
                    <h3>Cuidado</h3>
                    <a href="#">Cremas y lociones</a>
                    <a href="#">Aceites para barba</a>
                </div>
                <div class="col-md-4">
                    <h3>Accesorios</h3>
                    <a href="#">Peines y cepillos</a>
                    <a href="#">Tijeras</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Uñas</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-5">
                    <h3>UÑAS</h3>
                    <a href="#">Esmaltes</a>
                    <a href="#">Gel para uñas</a>
                    <a href="#">Tratamientos para uñas</a>
                </div>
                <div class="col-md-5">
                    <h3>Accesorios</h3>
                    <a href="#">Limas</a>
                    <a href="#">Pinceless</a>
                </div>
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
    