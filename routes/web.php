<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReporteController;

/*
Route::post('/login', [UserController::class, 'login']);
Route::post('/user/add', [UserController::class, 'store']);
Route::get('/productos',[ProductoController::class,'index']);

//crud de productos
Route::get('/productos/listar',[ProductoController::class,'index']);//Listar
Route::post('/producto/add', [ProductoController::class, 'store']);//Registrar
Route::get('/producto/show/{id}',[ProductoController::class,'show']);//Listar
Route::put('/producto/update/{id}', [ProductoController::class, 'update']);//Actualizar
Route::delete('/producto/delete/{id}', [ProductoController::class, 'destroy']);//Eliminar

Route::post('/logout', [UserController::class, 'logout']);
Route::get('/login/all', [UserController::class, 'index']);
//Route::get('/productos',[ProductoController::class,'index']);

//crud de categorias
Route::get('/categoria/index', [CategoriaController::class, 'index']);//Listar
Route::post('/categoria/add', [CategoriaController::class, 'store']);//Registrar
Route::get('/categoria/show/{id}',[CategoriaController::class,'show']);//Listar
Route::put('/categoria/update/{id}', [CategoriaController::class, 'update']);//Actualizar
Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'destroy']);//Eliminar

*/
 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
 

 
Route::get('/', function () {
    return view('auth/login');
});
// gestionar los productos
Route::get('/producto/create',[ProductoController::class,'create']);
Route::post('/producto/store', [ProductoController::class, 'store']);//Registrar
Route::get('/producto/index',[ProductoController::class,'index']);
Route::get('/producto/show/{id}', [ProductoController::class, 'show']);//ver
Route::get('/producto/{id}/edit', [ProductoController::class, 'edit']);//Actualizar
Route::post('/producto/update/{id}', [ProductoController::class, 'update']);//Registrar
Route::get('/producto/{id}/delete', [ProductoController::class, 'destroy']);//Actualizar

//gestionar las categorias
Route::get('/categoria/create',[CategoriaController::class,'create']);
Route::post('/categoria/store', [CategoriaController::class, 'store']);//Registrar
Route::get('/categoria/index',[CategoriaController::class,'index']);
Route::get('/categoria/show/{id}', [CategoriaController::class, 'show']);//ver
Route::get('/categoria/{id}/edit', [CategoriaController::class, 'edit']);//Actualizar
Route::post('/categoria/update/{id}', [CategoriaController::class, 'update']);//Registrar
Route::get('/categoria/{id}/delete', [CategoriaController::class, 'destroy']);//Actualizar

//gestionar los proveedores
Route::get('/proveedor/create',[ProveedorController::class,'create']);
Route::post('/proveedor/store', [ProveedorController::class, 'store']);//Registrar
Route::get('/proveedor/index',[ProveedorController::class,'index']);
Route::get('/proveedor/show/{id}', [ProveedorController::class, 'show']);//ver
Route::get('/proveedor/{id}/edit', [ProveedorController::class, 'edit']);//Actualizar
Route::post('/proveedor/update/{id}', [ProveedorController::class, 'update']);//Registrar
Route::get('/proveedor/{id}/delete', [ProveedorController::class, 'destroy']);//Actualizar

//gestionar los personales
Route::get('/personal/create',[PersonalController::class,'create']);
Route::post('/personal/store', [PersonalController::class, 'store']);//Registrar
Route::get('/personal/index',[PersonalController::class,'index']);
Route::get('/personal/show/{id}', [PersonalController::class, 'show']);//ver
Route::get('/personal/{id}/edit', [PersonalController::class, 'edit']);//Actualizar
Route::post('/personal/update/{id}', [PersonalController::class, 'update']);//Registrar
Route::get('/personal/{id}/delete', [PersonalController::class, 'destroy']);//Actualizar

//gestionar el inventario
Route::get('/inventario/create',[InventarioController::class,'create']);
Route::post('/inventario/store', [InventarioController::class, 'store']);//Registrar
Route::get('/inventario/index',[InventarioController::class,'index']);
Route::get('/inventario/show/{id}', [InventarioController::class, 'show']);//ver
Route::get('/inventario/{id}/edit', [InventarioController::class, 'edit']);//Actualizar
Route::post('/inventario/update/{id}', [InventarioController::class, 'update']);//Registrar
Route::get('/inventario/{id}/delete', [InventarioController::class, 'destroy']);//Actualizar

//gestionar los compras
Route::get('/compra/create',[CompraController::class,'create']);
Route::post('/compra/store', [CompraController::class, 'store']);//Registrar
Route::get('/compra/index',[CompraController::class,'index']);
Route::get('/compra/show/{id}', [CompraController::class, 'show']);//ver
Route::get('/compra/{id}/edit', [CompraController::class, 'edit']);//Actualizar
Route::post('/compra/update/{id}', [CompraController::class, 'update']);//Registrar
Route::get('/compra/{id}/delete', [CompraController::class, 'destroy']);//Actualizar

Route::get('/deletedetallecompra/{id}', [CompraController::class, 'destroydetallecompra']); //eliminar detalle compra

//gestionar los roles
Route::get('/rol/create',[RoleController::class,'create']);
Route::post('/rol/store', [RoleController::class, 'store']);//Registrar
Route::get('/rol/index',[RoleController::class,'index']);
Route::get('/rol/show/{id}', [RoleController::class, 'show']);//ver
Route::get('/rol/{id}/edit', [RoleController::class, 'edit']);//Actualizar
Route::post('/rol/update/{id}', [RoleController::class, 'update']);//Registrar
Route::get('/rol/{id}/delete', [RoleController::class, 'destroy']);//Actualizar

//gestionar los USUARIOS
Route::get('/usuario/create',[UserController::class,'create']);
Route::post('/usuario/store', [UserController::class, 'store']);//Registrar
Route::get('/usuario/index',[UserController::class,'index']);
Route::get('/usuario/show/{id}', [UserController::class, 'show']);//ver
Route::get('/usuario/{id}/edit', [UserController::class, 'edit']);//Actualizar
Route::post('/usuario/update/{id}', [UserController::class, 'update']);//Registrar
Route::get('/usuario/{id}/delete', [UserController::class, 'destroy']);//Actualizar

//gestionar los clientes
Route::get('/cliente/create',[ClienteController::class,'create']);
Route::post('/cliente/store', [ClienteController::class, 'store']);//Registrar
Route::get('/cliente/index',[ClienteController::class,'index']);
Route::get('/cliente/show/{id}', [ClienteController::class, 'show']);//ver
Route::get('/cliente/{id}/edit', [ClienteController::class, 'edit']);//Actualizar
Route::post('/cliente/update/{id}', [ClienteController::class, 'update']);//Registrar
Route::get('/cliente/{id}/delete', [ClienteController::class, 'destroy']);//Actualizar

//gestionar los ventas
Route::get('/venta/create',[VentaController::class,'create']);
Route::post('/venta/store', [VentaController::class, 'store']);//Registrar
Route::get('/venta/index',[VentaController::class,'index']);
Route::get('/venta/show/{id}', [VentaController::class, 'show']);//ver
Route::get('/venta/{id}/edit', [VentaController::class, 'edit']);//Actualizar
Route::post('/venta/update/{id}', [VentaController::class, 'update']);//Registrar
Route::get('/venta/{id}/delete', [VentaController::class, 'destroy']);//Actualizar

Route::get('/deletedetalleventa/{id}', [VentaController::class, 'destroydetalleventa']); //eliminar detalle compra

// rutas para generar el pdf de la boleta 
Route::get('/pdf/generar',[PdfController::class,'createPDF']);
Route::get('/generarboletaventa/{id}',[PdfController::class,'boletaventa']);

//rutas para reportes de ventas

Route::get('/ventas/reportes',[ReporteController::class,'indexventas']);
Route::get('/ingresos',[ReporteController::class,'ingresos']);
Route::get('/nuestrasventas/{fechaI}/{fechaF}',[ReporteController::class,'nuestrasVentas']);
Route::get('/ventasenfecha/{fechaI}/{fechaF}',[ReporteController::class,'ventasenFecha']);
Route::get('/llenarcomboventas/{fechaI}/{fechaF}',[ReporteController::class,'ventasMarca']);
Route::get('/llenarcomboproductos/{fechaI}/{fechaF}',[ReporteController::class,'ventasProducto']);

//rutas para reportes de compras
Route::get('/compras/reportes',[ReporteController::class,'indexcompras']);
Route::get('/egresos',[ReporteController::class,'egresos']);
Route::get('/nuestrascompras/{fechaI}/{fechaF}',[ReporteController::class,'nuestrasCompras']);
Route::get('/comprasenfecha/{fechaI}/{fechaF}',[ReporteController::class,'comprasenFecha']);
Route::get('/llenarcombocompras/{fechaI}/{fechaF}',[ReporteController::class,'comprasMarca']);
Route::get('/llenarcomboproductoscompras/{fechaI}/{fechaF}',[ReporteController::class,'comprasProductos']);

//rutas para reportes de compras
Route::get('/productos/reportes',[ReporteController::class,'indexproductos']);
Route::get('/productos',[ReporteController::class,'productos']);
Route::get('/nuestrosproductosmas/{fechaI}/{fechaF}',[ReporteController::class,'nuestrosProductosMas']);
Route::get('/nuestrosproductosmenos/{fechaI}/{fechaF}',[ReporteController::class,'nuestrosProductosMenos']);
Route::get('/productosenfecha/{fechaI}/{fechaF}',[ReporteController::class,'productosenFecha']);
Route::get('/productosenfecha2/{fechaI}/{fechaF}',[ReporteController::class,'productosenFecha2']);

//rutas para reportes de compras
Route::get('/inventarios/reportes',[ReporteController::class,'indexinventarios']);
Route::get('/inventarios',[ReporteController::class,'inventarios']);
Route::get('/inventariosmenor/{limite}',[ReporteController::class,'inventariosMenor']);
Route::get('/inventariosmayor/{limite}',[ReporteController::class,'inventariosMayor']);
Route::get('/inventarioslimite/{limite}',[ReporteController::class,'inventariosLimite']);
Route::get('/inventarioslimite2/{limite}',[ReporteController::class,'inventariosLimite2']);


