<?php

use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inativo', [IndexController::class, 'inactive'])->name('inactive');

Route::prefix('caixa')->group(function (){
    Route::get('/gerenciar-caixas', [BoxController::class, 'manageBoxes'])->name('manageBoxes');
    Route::post('/adicionar', [BoxController::class, 'store'])->name('storeBox');
    Route::get('/excluir/{id}', [BoxController::class, 'delete'])->name('deleteBox');
    Route::get('/editar/{id}', [BoxController::class, 'manageBoxes'])->name('setUpdateBox');
    Route::post('/editar', [BoxController::class, 'update'])->name('updateBox');
    Route::get('/visualizar/{id}', [BoxController::class, 'view'])->name('viewBox');
});

Route::prefix('aluno')->group(function (){
    Route::get('/adicionar/{id}', [StudentController::class, 'setStore'])->name('setStoreStudent');
    Route::post('/adicionar', [StudentController::class, 'store'])->name('storeStudent');
    Route::get('/excluir/{id}', [StudentController::class, 'delete'])->name('deleteStudent');
});

