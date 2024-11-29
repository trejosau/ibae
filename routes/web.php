<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\loginGoogleController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UsuarioController;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Http\Request;

use App\Livewire\CatalogoTienda;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

Route::get('/todosLosProductos', function () {
    $productos = Productos::all();
       return $productosArray = $productos->toArray();
});

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/about-us', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');


Route::get('/cursos', function () {
    return view('cursos');
})->name('cursos.info');

Route::get('/phpinfo', function () {
    return phpinfo();
});


Route::get('auth/google', [loginGoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [loginGoogleController::class, 'handleGoogleCallback'])->name('login.google.callback');



Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image-update', [ProfileController::class, 'imageUpdate'])->name('profile.imageUpdate');
    Route::get('/checkout', [ProductosController::class, 'checkout'])->name('checkout');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});

Route::get('/salon', [SalonController::class, 'index'])->name('salon.index');
Route::middleware('auth')->group(function () {
    Route::get('/salon/agendar', [SalonController::class, 'agendar'])->name('salon.agendar');
    Route::get('/salon/confirmar', [SalonController::class, 'confirmar'])->name('salon.confirmar');
});



Route::middleware(['auth'])->group(function () {
    Route::middleware('role:admin|estilista')->group(function () {
        Route::get('/dashboard/citas', [DashboardController::class, 'citas'])->name('dashboard.citas');
        Route::get('/dashboard/servicios', [DashboardController::class, 'servicios'])->name('dashboard.servicios');
        Route::post('/dashboard/servicios/agregar', [ServiciosController::class, 'agregarServicio'])->name('servicios.agregar');
        Route::post('/dashboard/servicios/agregar-categoria', [ServiciosController::class, 'agregarCategoria'])->name('servicios.agregarCategoria');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboardd');
        Route::get('/dashboard/inicio', [DashboardController::class, 'inicio'])->name('dashboard.inicio');
        Route::get('/dashboard/ventas', [DashboardController::class, 'ventas'])->name('dashboard.ventas');
        Route::get('/dashboard/ventas/{id]', [DashboardController::class, 'ventaDestroy'])->name('ventas.destroy');
        Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('dashboard.pedidos');
        Route::post('/pedidos/marcar-listo/{id}', [PedidoController::class, 'marcarListo'])->name('pedido.marcarListo');
        Route::post('/pedidos/marcar-entregado/{id}', [PedidoController::class, 'marcarEntregado'])->name('pedido.marcarEntregado');
        Route::get('/dashboard/compras', [DashboardController::class, 'compras'])->name('dashboard.compras');
        Route::post('/dashboard/compras/proveedores', [DashboardController::class, 'proveedoresCreate'])->name('proveedores.store');
        Route::put('/dashboard/compras/proveedores/{id}/update', [DashboardController::class, 'proveedoresUpdate'])->name('proveedores.update');
        Route::delete('/dashboard/compras/proveedores/{id}', [DashboardController::class, 'proveedoresDestroy'])->name('proveedores.destroy');
        Route::post('/dashboard/compras/agregar', [CompraController::class, 'agregar'])->name('compra.agregar');
        Route::post('/dashboard/compras/cancelar/{id}', [DashboardController::class, 'compraCancelar'])->name('compra.cancelar');
        Route::get('/dashboard/compras/detallada/{id}', [DashboardController::class, 'compraDetallada'])->name('compra.detallada');
        Route::post('/dashboard/compras/entregada/{id}', [DashboardController::class, 'compraEntregada'])->name('compra.entregada');
        Route::get('/dashboard/compras/catalogo/{id}', [CompraController::class, 'detallarProducto'])->name('detallar.producto');
        Route::post('/dashboard/compras/agregar-producto', [CompraController::class, 'agregarProducto'])->name('compra.agregarProducto');
        Route::get('/dashboard/compras/limpiar-carrito/{id}', [CompraController::class, 'limpiarCarrito'])->name('compra.limpiarCarrito');
        Route::post('/dashboard/compras/quitar-producto', [CompraController::class, 'quitarProducto'])->name('compra.quitarProducto');
        Route::get('/dashboard/productos', [DashboardController::class, 'productos'])->name('dashboard.productos');
        Route::get('/dashboard/subcategorias/{id_categoria}', [DashboardController::class, 'obtenerSubcategorias']);
        Route::post('/dashboard/productos/agregar', [ProductosController::class, 'agregar'])->name('productos.agregar');
        Route::put('/dashboard/productos/actualizar/{id}', [ProductosController::class, 'actualizar'])->name('productos.update');
        Route::put('/dashboard/productos/retirar/{id}', [ProductosController::class, 'retirar'])->name('productos.retirar');
        Route::post('/categorias/store', [ProductosController::class, 'storeCategoria'])->name('categorias.store');
        Route::post('/subcategorias/store', [ProductosController::class, 'storeSubcategoria'])->name('subcategorias.store');
        Route::delete('/subcategorias/{id}', [ProductosController::class, 'eliminarSubcategoria'])->name('subcategorias.destroy');
        Route::delete('/productos/{producto}/subcategoria/{subcategoria}', [ProductosController::class, 'eliminarSubcategoriaProducto'])->name('productos.subcategoria.destroy');
        Route::post('/productos/{producto}/subcategoria', [ProductosController::class, 'agregarSubcategoria'])->name('productos.subcategoria.agregar');
        Route::get('/dashboard/usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');
        Route::post('/dashboard/usuarios/agregarAdmin', [UsuarioController::class, 'agregarAdmin'])->name('usuarios.agregarAdmin');
        Route::post('/dashboard/usuarios/agregarEstilista', [UsuarioController::class, 'agregarEstilista'])->name('usuarios.agregarEstilista');
        Route::post('/dashboard/usuarios/agregarProfesor', [UsuarioController::class, 'agregarProfesor'])->name('usuarios.agregarProfesor');
        Route::get('/dashboard/auditoria', [DashboardController::class, 'auditoria'])->name('dashboard.auditoria');
        Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/notificaciones/marcar-leida/{id}', [NotificacionesController::class, 'marcarLeida'])->name('notificaciones.marcarLeida');

        // Rutas para las gráficas

    });
});

Route::get('/graficas/colegiaturas', [GraficasController::class, 'obtenerTotalPorMesAcademia'])->name('graficas.colegiaturas');
Route::get('/graficas/salon', [GraficasController::class, 'obtenerTotalSalon'])->name('graficas.salon');
Route::get('/graficas/tienda', [GraficasController::class, 'obtenerTotalVentas'])->name('graficas.tienda');
Route::get('/graficas/data', [GraficasController::class, 'obtenerData'])->name('graficas.data');



Route::middleware(['auth', 'role:profesor|admin|estudiante'])->group(function ()
    {
        Route::get('/plataforma/', function () {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return Redirect::to('/plataforma/espacio/mis-cursos');
            }

            if ($user->hasRole('profesor')) {
                return Redirect::to('/plataforma/cursos/historial-cursos');
            }

            if ($user->hasRole('estudiante')) {
                return Redirect::to('/plataforma/espacio/perfil');
            }

            // Redirección predeterminada si no tiene rol específico
            return Redirect::to('/home');
        })->name('plataforma');



        Route::middleware(['role:estudiante'])->group(function () {
            Route::get('/plataforma/espacio/mis-cursos', [PlataformaController::class, 'misCursosEspacio'])->name('plataforma.espacio-mis-cursos');
            Route::get('/plataforma/espacio/mis-pagos', [PlataformaController::class, 'misPagosEspacio'])->name('plataforma.espacio-mis-pagos');
            Route::get('/plataforma/espacio/perfil', [PlataformaController::class, 'perfilEspacio'])->name('plataforma.espacio-perfil');
        });

        Route::middleware(['role:profesor|admin'])->group(function () {
            Route::get('/plataforma/cursos/historial-cursos', [PlataformaController::class, 'historialCursos'])->name('plataforma.historial-cursos');
            Route::get('/plataforma/cursos/ver-asistencia/{curso_apertura_id}', [PlataformaController::class, 'registrarAsistencia'])->name('plataforma.registrarAsistencia');
            Route::post('/plataforma/cursos/guardar-asistencia/{curso_apertura_id}', [PlataformaController::class, 'guardarAsistencia'])->name('guardarAsistencia');
        });

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/plataforma/cursos/mis-cursos', [PlataformaController::class, 'misCursos'])->name('plataforma.mis-cursos');
            Route::post('/plataforma/cursos/crear-curso', [PlataformaController::class, 'store'])->name('cursos.store');
            Route::post('/plataforma/cursos/guardar-curso-apertura', [PlataformaController::class, 'storeCursoApertura'])->name('plataforma.storeCursoApertura');
            Route::post('/inscribir-alumno', [PlataformaController::class, 'storeAlumnoCurso'])->name('inscribirAlumno');
            Route::get('/quitar-alumno', [PlataformaController::class, 'quitarAlumnoCurso'])->name('darDeBaja');
            Route::post('/cursos/cambiar-estado', [PlataformaController::class, 'cambiarEstado'])->name('cursos.cambiarEstado');
            Route::delete('/cursos/{id}', [PlataformaController::class, 'cursoDestroy'])->name('plataforma.cursoDestroy');
            Route::get('/plataforma/cursos/iniciar-cursos', [PlataformaController::class, 'iniciarCursosHoy'])->name('plataforma.iniciarCursos');

            // Rutas de Módulos
            Route::get('/plataforma/modulos/lista', [PlataformaController::class, 'listaModulos'])->name('plataforma.lista-modulos');
            Route::get('/modulo/modificar/{id}', [PlataformaController::class, 'actualizarModulo'])->name('plataforma.actualizarModulo');
            Route::post('/modulos', [PlataformaController::class, 'crearModulo'])->name('plataforma.crearModulo');
            Route::delete('/modulo/eliminar/{id}', [PlataformaController::class, 'eliminarModulo'])->name('plataforma.eliminarModulo');
            Route::put('/plataforma/modulos/{id}', [PlataformaController::class, 'moduloUpdate'])->name('plataforma.moduloUpdate');

            // Rutas de Asignación de Módulos a Temas
            Route::get('/temas-modulos', [PlataformaController::class, 'ligarModulosATemas'])->name('ligarTemasModulo');
            Route::post('/plataforma/asignar-temas', [PlataformaController::class, 'asignarTemas'])->name('asignar.temas');
            Route::post('/eliminar-tema', [PlataformaController::class, 'eliminarTemaDeModulo'])->name('eliminar.tema');

            // Rutas para temas
            Route::put('/tema/modificar/{id}', [PlataformaController::class, 'actualizarTema'])->name('plataforma.actualizarTema');
            Route::delete('/tema/eliminar/{id}', [PlataformaController::class, 'eliminarTema'])->name('plataforma.eliminarTema');
            Route::post('/temas', [PlataformaController::class, 'crearTema'])->name('plataforma.crearTema');
            Route::put('/modulos/{modulo}/actualizar-temas', [PlataformaController::class, 'actualizarTemas'])->name('modulos.actualizarTemas');


            // Rutas de Personal
            Route::get('/plataforma/personal/estudiantes', [PlataformaController::class, 'estudiantes'])->name('plataforma.estudiantes');
            Route::get('/plataforma/personal/inscripciones', [PlataformaController::class, 'inscripciones'])->name('plataforma.inscripciones');

            // Rutas de Finanzas
            Route::get('/plataforma/finanzas/pagos', [PlataformaController::class, 'pagos'])->name('plataforma.pagos');
            Route::get('/plataforma/finanzas/historial-pagos', [PlataformaController::class, 'historialPagos'])->name('plataforma.historial-pagos');

            Route::post('/certificados', [PlataformaController::class, 'storeCertificado'])->name('certificados.store');
            Route::put('/plataforma/actualizarModulo/{id}', [PlataformaController::class, 'actualizarModulo'])->name('plataforma.actualizarModulo');
            Route::put('/plataforma/actualizarTema/{id}', [PlataformaController::class, 'actualizarTema'])->name('plataforma.actualizarTema');
            Route::post('/registrar-estudiante', [PlataformaController::class, 'registrarEstudiante'])->name('plataforma.registrarEstudiante');
            Route::post('/estudiante/{matricula}/baja', [PlataformaController::class, 'darDeBaja'])->name('plataforma.baja');
            Route::post('/estudiante/{matricula}/alta', [PlataformaController::class, 'darDeAlta'])->name('plataforma.alta');


            Route::post('/inscripciones', [PlataformaController::class, 'storeInscripcion'])->name('plataforma.storeInscripcion');
            Route::put('/inscripciones/{id}', [PlataformaController::class, 'update'])->name('plataforma.updateInscripcion');
            Route::delete('/inscripciones/{id}', [PlataformaController::class, 'destroy'])->name('inscripciones.destroy');




            Route::post('/plataforma/bajaProfesor/{id}', [PlataformaController::class, 'bajaProfesor'])->name('plataforma.bajaProfesor');
            Route::post('/plataforma/asignar-rol', [PlataformaController::class, 'asignarRol'])->name('plataforma.asignarRol');


        });
});




Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/checkout', [ProductosController::class, 'checkout'])->name('checkout');
    Route::post('/pago', [ProductosController::class, 'pago'])->name('pago'); // Procesa el pago y redirige a Stripe
    Route::get('/success', [ProductosController::class, 'success'])->name('success');
    Route::get('/cancel', [ProductosController::class, 'cancel'])->name('cancel');
});

Route::get('/tienda', [ProductosController::class, 'mostrar'])->name('tienda.mostrar');
Route::get('/carrito', [ProductosController::class, 'verCarrito'])->name('carrito.ver');
Route::get('/carrito/contenido', [ProductosController::class, 'cargarContenidoCarrito'])->name('carrito.contenido');
Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::post('/producto/{id}/agregar-al-carrito', [ProductosController::class, 'agregarAlCarrito'])->name('producto.agregar');
Route::delete('/carrito/{id}', [ProductosController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
Route::get('/categorias', [ProductosController::class, 'obtenerCategorias']);
Route::get('/catalogo/', [ProductosController::class, 'catalogo'])->name('catalogo');






Route::get('/producto/{id}', [ProductosController::class, 'mostrarDetalle'])->name('producto.detalle');
Route::get('/tienda', [ProductosController::class, 'mostrar'])->name('tienda.mostrar');
Route::get('/pedidos', [ProductosController::class, 'mostrarPedidos'])->name('tienda.mis-pedidos');







