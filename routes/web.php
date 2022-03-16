<?php

use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inativo', [IndexController::class, 'inactive'])->name('inactive');

Route::prefix('caixa')->group(function (){
    Route::get('/gerenciar-caixas', [BoxController::class, 'manageBoxes'])->name('manageBoxes');
    Route::post('/adicionar', [BoxController::class, 'store'])->name('storeBox');
    Route::get('/excluir/{id}', [BoxController::class, 'delete'])->name('deleteBox');
    Route::get('/editar/{id}', [BoxController::class, 'manageBoxes'])->name('setUpdateBox');
    Route::post('/editar', [BoxController::class, 'update'])->name('updateBox');
});

