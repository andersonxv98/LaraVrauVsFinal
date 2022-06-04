<?php

use App\Http\Controllers\CLienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resources([
    'categoria' => \App\Http\Controllers\CategoriaController::class,
    'produto' => \App\Http\Controllers\ProdutoController::class
]);

Route::get("/", [HomeController::class, 'index']);

Route::get("/detalhe/{id}", [HomeController::class, 'detalhe']);

Route::get('/dashboard', [DashboardController::class,
    'dashboard'])->name('dashboard');

Route::get('/carrinho',
    [CompraController::class, 'compras'])->name('carrinho');

Route::get('/adicionar/{id}',
    [CompraController::class, 'adicionar'])
    ->name('adicionar');

Route::get('/remover/{id}',
    [CompraController::class, 'remover'])
    ->name('remover');

Route::get('/finalizar/',
    [CompraController::class, 'finalizar'])
    ->name('finalizar');

Route::get('/carrinho/add/{id}', [CLienteController::class, 'adicionar_carrinho'])
->name('adicionar_carrinho');

Route::get('/carrinho/remove', [CLienteController::class, 'remover_carrinho'])
->name('remover_carrinho');

Route::get('/carrinho/checkout', [CLienteController::class, 'encerrar_compra'])
->name('encerrar_compra');

require __DIR__.'/auth.php';
