<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PosicionesController;
use App\Http\Controllers\EmpresasPosicionesController;


Route::get('/productos', [ProductosController::class, 'index']);
Route::get('/productos/{id}', [ProductosController::class, 'show']);
Route::post('/productos', [ProductosController::class, 'store']);
Route::put('/productos/{id}', [ProductosController::class, 'update']);
Route::patch('/productos/{id}', [ProductosController::class, 'updatePartial']);
Route::delete('/productos/{id}', [ProductosController::class, 'destroy']);

Route::get('/posiciones', [PosicionesController::class, 'index']);
Route::post('/posiciones', [PosicionesController::class, 'store']);
Route::get('/posiciones/frecuente', [PosicionesController::class, 'frecuently']);
Route::get('/posiciones/listado', [PosicionesController::class, 'union']);

Route::get('/empresas', [EmpresasPosicionesController::class, 'index']);
