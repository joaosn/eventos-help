<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\EventConfirmationController;
use App\Http\Controllers\UsersController;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

Route::middleware(['auth'])->group(function () {
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('servico', ServicoController::class);
    Route::resource('locais', LocalController::class);
    Route::resource('users', UsersController::class);
    Route::get('/events/create', [EventController::class, 'create']);
    Route::get('/rel-eventos-users', [EventController::class, 'relEventsUsers'])->name('events.relUsers');
    Route::get('/rel-eventos', [EventController::class, 'relEvents'])->name('events.relEvents');
    Route::get('/rel-servicos', [ServicoController::class, 'relServicos'])->name('events.relServicos');
    Route::post('/events/{event}/confirm', [EventConfirmationController::class, 'confirm'])->name('events.confirm');
    Route::get('/events/{event}/qrcode', [EventConfirmationController::class, 'index'])->name('events.qrcode');
    Route::post('/events/{event}/getQrcode', [EventConfirmationController::class, 'getQrcode'])->name('events.getQrcode');
    Route::get('/dashboard', [EventController::class, 'dashboard']);
});



Route::post('/eventsconfirm', [EventConfirmationController::class, 'qrcodeConfirm'])->name('events.qrcodeConfirm');
Route::get('/eventsqrcode', [EventConfirmationController::class, 'showQrcode'])->name('events.showQrcode');


Route::get('/contato', function () {
    return view('contato');
});


