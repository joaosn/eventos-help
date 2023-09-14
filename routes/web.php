<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\LocalController;


Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

Route::middleware(['auth'])->group(function () {
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('servico', ServicoController::class);
    Route::resource('locais', LocalController::class);
});


Route::get('/contato', function () {
    return view('contato');
});

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

