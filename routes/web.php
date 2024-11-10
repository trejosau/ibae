<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\loginGoogleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/inicio', [DashboardController::class, 'inicio'])->name('dashboard.inicio');
    Route::get('/dashboard/ventas', [DashboardController::class, 'ventas'])->name('dashboard.ventas');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('dashboard.pedidos');
    Route::post('/ventas/agregar-producto', [VentaController::class, 'agregarProducto'])->name('ventas.agregarProducto');
    Route::get('/ventas/total', [VentaController::class, 'obtenerTotal'])->name('ventas.total');
    Route::post('/ventas/quitar-producto', [VentaController::class, 'quitarProducto'])->name('ventas.quitarProducto');
    Route::post('/ventas/realizar', [VentaController::class, 'store'])->name('ventas.store');
    Route::delete('/ventas/eliminar/{id}', [VentaController::class, 'eliminar'])->name('ventas.destroy');
    Route::get('/ventas/limpiarCarrito', [VentaController::class, 'limpiarCarrito'])->name('limpiarCarrito');
    Route::get('/ventas/buscarMatricula', [VentaController::class, 'buscarMatriculas'])->name('buscar.matriculas');
    Route::post('/pedidos/marcar-listo/{id}', [PedidoController::class, 'marcarListo'])->name('pedido.marcarListo');
    Route::post('/pedidos/marcar-entregado/{id}', [PedidoController::class, 'marcarEntregado'])->name('pedido.marcarEntregado');
    Route::get('/dashboard/compras', [DashboardController::class, 'compras'])->name('dashboard.compras');
    Route::post('/dashboard/compras/proveedores', [DashboardController::class, 'proveedoresCreate'])->name('proveedores.store');
    Route::put('/dashboard/compras/proveedores/{id}/update', [DashboardController::class, 'proveedoresUpdate'])->name('proveedores.update');
    Route::delete('/dashboard/compras/proveedores/{id}', [DashboardController::class, 'proveedoresDestroy'])->name('proveedores.destroy');
    Route::post('/dashboard/compras/cancelar/{id}', [DashboardController::class, 'compraCancelar'])->name('compra.cancelar');
    Route::get('/dashboard/compras/recibida/{id}', [DashboardController::class, 'compraRecibida'])->name('compra.recibida');
    Route::get('/dashboard/compras/catalogo/{id}', [CompraController::class, 'detallarProducto'])->name('detallar.producto');
    Route::post('/dashboard/compras/agregar-producto', [CompraController::class, 'agregarProducto'])->name('compra.agregarProducto');
    Route::get('/dashboard/compras/limpiar-carrito/{id}', [CompraController::class, 'limpiarCarrito'])->name('compra.limpiarCarrito');
    Route::post('/dashboard/compras/quitar-producto', [CompraController::class, 'quitarProducto'])->name('compra.quitarProducto');
    Route::get('/dashboard/compras/total', [CompraController::class, 'obtenerTotal'])->name('compra.total');
    Route::get('/dashboard/citas', [DashboardController::class, 'citas'])->name('dashboard.citas');
    Route::get('/dashboard/servicios', [DashboardController::class, 'servicios'])->name('dashboard.servicios');
    Route::get('/dashboard/productos', [DashboardController::class, 'productos'])->name('dashboard.productos');
    Route::get('/dashboard/usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');
    Route::get('/dashboard/auditoria', [DashboardController::class, 'auditoria'])->name('dashboard.auditoria');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
});

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/about-us', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/plataforma/', function () {
    return Redirect::route('plataforma.mis-cursos');
})->name('plataforma');

Route::middleware('auth')->group(function () {
    // Rutas de Cursos
    Route::get('/plataforma/cursos/mis-cursos', [PlataformaController::class, 'misCursos'])->name('plataforma.mis-cursos');
    Route::get('/plataforma/cursos/historial-cursos', [PlataformaController::class, 'historialCursos'])->name('plataforma.historial-cursos');
    Route::post('/plataforma/cursos/guardar-curso-apertura', [PlataformaController::class, 'storeCursoApertura'])->name('plataforma.storeCursoApertura');
    Route::post('/inscribir-alumno', [PlataformaController::class, 'storeAlumnoCurso'])->name('inscribirAlumno');
    Route::get('/quitar-alumno', [PlataformaController::class, 'quitarAlumnoCurso'])->name('darDeBaja');
    Route::get('/plataforma/cursos/ver-asistencia/{curso_apertura_id}', [PlataformaController::class, 'registrarAsistencia'])->name('plataforma.registrarAsistencia');
    Route::post('/plataforma/cursos/guardar-asistencia/{curso_apertura_id}', [PlataformaController::class, 'guardarAsistencia'])->name('guardarAsistencia');
    Route::post('/cursos', [PlataformaController::class, 'store'])->name('cursos.store');
    Route::post('/cursos/cambiar-estado', [PlataformaController::class, 'cambiarEstado'])->name('cursos.cambiarEstado');
    Route::delete('/cursos/{id}', [PlataformaController::class, 'cursoDestroy'])->name('plataforma.cursoDestroy');
    Route::get('/plataforma/cursos/iniciar-cursos', [PlataformaController::class, 'iniciarCursosHoy'])->name('plataforma.iniciarCursos');


    // Rutas de Módulos
    Route::get('/plataforma/modulos/lista', [PlataformaController::class, 'listaModulos'])->name('plataforma.lista-modulos');
    Route::post('/plataforma/modulos/store', [PlataformaController::class, 'moduloStore'])->name('plataforma.moduloStore');
    Route::put('/plataforma/modulos/{id}', [PlataformaController::class, 'moduloUpdate'])->name('plataforma.moduloUpdate');
    Route::delete('/plataforma/modulos/{id}', [PlataformaController::class, 'moduloDestroy'])->name('plataforma.moduloDestroy');
    Route::get('/plataforma/modulos/temas', [PlataformaController::class, 'temasModulos'])->name('plataforma.temas-modulos');
    Route::get('/temas-modulos', [PlataformaController::class, 'ligarModulosATemas'])->name('ligarTemasModulo');
    Route::post('/plataforma/asignar-temas', [PlataformaController::class, 'asignarTemas'])->name('asignar.temas');
    Route::post('/modulos', [PlataformaController::class, 'crearModulo'])->name('plataforma.crearModulo');
    Route::get('/modulo/modificar/{id}', [PlataformaController::class, 'modificarModulo'])->name('plataforma.modificarModulo');
    Route::delete('/modulo/eliminar/{id}', [PlataformaController::class, 'eliminarModulo'])->name('plataforma.eliminarModulo');


    // Rutas para temas
    Route::get('/tema/modificar/{id}', [PlataformaController::class, 'modificarTema'])->name('plataforma.modificarTema');
    Route::delete('/tema/eliminar/{id}', [PlataformaController::class, 'eliminarTema'])->name('plataforma.eliminarTema');
    Route::post('/temas', [PlataformaController::class, 'crearTema'])->name('plataforma.crearTema');

    // Rutas de Personal
    Route::get('/plataforma/personal/estudiantes', [PlataformaController::class, 'estudiantes'])->name('plataforma.estudiantes');
    Route::get('/plataforma/personal/inscripciones', [PlataformaController::class, 'inscripciones'])->name('plataforma.inscripciones');
    Route::get('/plataforma/personal/profesores', [PlataformaController::class, 'profesores'])->name('plataforma.profesores');

    // Rutas de Finanzas
    Route::get('/plataforma/finanzas/pagos', [PlataformaController::class, 'pagos'])->name('plataforma.pagos');
    Route::get('/plataforma/finanzas/historial-pagos', [PlataformaController::class, 'historialPagos'])->name('plataforma.historial-pagos');

    // Rutas de Espacio
    Route::get('/plataforma/espacio/mis-cursos', [PlataformaController::class, 'misCursosEspacio'])->name('plataforma.espacio-mis-cursos');
    Route::get('/plataforma/espacio/mis-pagos', [PlataformaController::class, 'misPagosEspacio'])->name('plataforma.espacio-mis-pagos');
    Route::get('/plataforma/espacio/perfil', [PlataformaController::class, 'perfilEspacio'])->name('plataforma.espacio-perfil');

    // Rutas adicionales
    Route::post('/certificados', [PlataformaController::class, 'storeCertificado'])->name('certificados.store');
    Route::post('/plataforma/store-curso-apertura', [PlataformaController::class, 'storeCursoApertura'])->name('plataforma.storeCursoApertura');

    Route::put('/plataforma/actualizarModulo/{id}', [PlataformaController::class, 'actualizarModulo'])->name('plataforma.actualizarModulo');
    Route::put('/plataforma/actualizarTema/{id}', [PlataformaController::class, 'actualizarTema'])->name('plataforma.actualizarTema');

    Route::post('/estudiante/{matricula}/baja', [PlataformaController::class, 'darDeBaja'])->name('plataforma.baja');

    Route::post('/inscripciones', [PlataformaController::class, 'storeInscripcion'])->name('plataforma.storeInscripcion');

    Route::put('/inscripciones/{id}', [PlataformaController::class, 'update'])->name('plataforma.updateInscripcion');
    Route::post('/plataforma/bajaProfesor/{id}', [PlataformaController::class, 'bajaProfesor'])->name('plataforma.bajaProfesor');



});



    Route::get('/tienda', [ProductosController::class, 'index'])->name('tienda'); // Ruta para la tienda principal
    // Mostrar todos los productos sin filtros
Route::get('/catalogo', [ProductosController::class, 'catalogo'])->name('catalogo');

// Filtrar productos desde el formulario
Route::post('/catalogo', [ProductosController::class, 'filtrar'])->name('productos.filtrar');

// Filtrar productos por categoría desde URL
Route::get('/catalogo/categoria/{id_categoria?}', [ProductosController::class, 'filtrar'])->name('productos.categoria');

    Route::get('/producto/{id}', [ProductosController::class, 'mostrarDetalle'])->name('producto.detalle');
    Route::get('/buscar', [ProductosController::class, 'buscar'])->name('buscar');
    Route::get('/tienda', [ProductosController::class, 'mostrar'])->name('tienda.mostrar');
    Route::get('auth/google', [loginGoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [loginGoogleController::class, 'handleGoogleCallback'])->name('login.google.callback');

    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/carrito', [ProductosController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/producto/{id}/agregar-al-carrito', [ProductosController::class, 'agregarAlCarrito'])->name('producto.agregar');
    Route::delete('/carrito/{id}', [ProductosController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
    Route::get('/carrito/contenido', [ProductosController::class, 'cargarContenidoCarrito'])->name('carrito.contenido');


    Route::middleware('auth')->group(function () {
    Route::get('/salon', [SalonController::class, 'index'])->name('salon.index');
    Route::get('/salon/agendar', [SalonController::class, 'agendar'])->name('salon.agendar');
    Route::get('/salon/confirmar', [SalonController::class, 'confirmar'])->name('salon.confirmar');
});

    Route::get('/graficas/colegiaturas', [GraficasController::class, 'obtenerTotalPorMesAcademia'])->name('graficas.colegiaturas');
    Route::get('/graficas/salon', [GraficasController::class, 'obtenerTotalSalon'])->name('graficas.salon');
    Route::get('/graficas/tienda', [GraficasController::class, 'obtenerTotalVentas'])->name('graficas.tienda');
    Route::get('/graficas/data', [GraficasController::class, 'obtenerData'])->name('graficas.data');


