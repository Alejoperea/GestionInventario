<?php

use App\Http\Controllers\api\CategoriaController;
use App\Http\Controllers\api\InventarioController;
use App\Http\Controllers\api\ProductoController;
use App\Http\Controllers\api\ProveedorController;
use App\Http\Controllers\api\TransaccionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rutas de Categorias

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::delete('/categorias/{categorias}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/{categorias}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::put('/categorias/{categorias}', [CategoriaController::class, 'update'])->name('categorias.update');

//Rutas de Producto

Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/{producto}', [ProductoController::class,'show'])->name('productos.show');
Route::put('/productos/{producto}',[ProductoController::class,'update'])->name('productos.update');

//Rutas de Inventario

Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios');
Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store');
Route::delete('/inventarios/{inventarios}', [InventarioController::class, 'destroy'])->name('inventarios.destroy');
Route::get('/inventarios/{inventarios}', [InventarioController::class,'show'])->name('inventarios.show');
Route::put('/inventarios/{inventarios}',[InventarioController::class,'update'])->name('inventarios.update');

//Rutas de Proveedor

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('provedores');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('provedores.store');
Route::delete('/proveedores/{proveedores}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
Route::get('/proveedores/{proveedores}', [ProveedorController::class,'show'])->name('proveedores.show');
Route::put('/proveedores/{proveedores}',[ProveedorController::class,'update'])->name('proveedores.update');

//Rutas de Transaccion

Route::get('/transacciones', [TransaccionController::class, 'index'])->name('transacciones');
Route::post('/transacciones', [TransaccionController::class, 'store'])->name('transacciones.store');
Route::delete('/transacciones/{transacciones}', [TransaccionController::class, 'destroy'])->name('transacciones.destroy');
Route::get('/transacciones/{transacciones}', [TransaccionController::class,'show'])->name('transacciones.show');
Route::put('/transacciones/{transacciones}',[TransaccionController::class,'update'])->name('transacciones.update');