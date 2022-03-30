<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TesteController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inativo', [IndexController::class, 'inactive'])->name('inactive');

Route::get('/teste', [TesteController::class, 'inserir'])->name('teste');

Route::prefix('caixa')->group(function (){
    Route::get('/gerenciar-caixas', [BoxController::class, 'manageBoxes'])->name('manageBoxes');
    Route::post('/adicionar', [BoxController::class, 'store'])->name('storeBox');
    Route::get('/excluir/{id}', [BoxController::class, 'delete'])->name('deleteBox');
    Route::get('/editar/{id}', [BoxController::class, 'manageBoxes'])->name('setUpdateBox');
    Route::post('/editar', [BoxController::class, 'update'])->name('updateBox');
    Route::get('/visualizar/{id}', [BoxController::class, 'view'])->name('viewBox');
    Route::get('/mostrar/{type}', [BoxController::class, 'show'])->name('showBox');
    Route::get('/imprimir/{id}', [BoxController::class, 'print'])->name('printBox');
    Route::get('/pesquisar', [BoxController::class, 'search'])->name('search');
});

Route::prefix('aluno')->group(function (){
    Route::get('/adicionar/{id}', [StudentController::class, 'setStore'])->name('setStoreStudent');
    Route::post('/adicionar', [StudentController::class, 'store'])->name('storeStudent');
    Route::get('/excluir/{id}', [StudentController::class, 'delete'])->name('deleteStudent');
    Route::get('/editar/{id}', [StudentController::class, 'setUpdate'])->name('setUpdateStudent');
    Route::post('/editar', [StudentController::class, 'update'])->name('updateStudent');
    Route::get('/resgatar/{id}', [StudentController::class, 'rescue'])->name('rescueStudent');
    Route::get('/trasferir/{id}', [StudentController::class, 'setTransfer'])->name('setTransferStudent');
    Route::post('/transferir', [StudentController::class, 'transfer'])->name('transferStudent');
});

Route::prefix('servidor')->group(function(){
    Route::get('/adicionar/{id}', [EmployeeController::class, 'setStoreBox'])->name('setStoreBoxEmployee');
    Route::post('/adicionar-caixa', [EmployeeController::class, 'storeBox'])->name('storeBoxEmployee');
    Route::get('/excluir/{id}', [EmployeeController::class, 'delete'])->name('deleteEmployee');
    Route::get('/editar-caixa/{id}', [EmployeeController::class, 'setUpdateBoxEmployee'])->name('setUpdateBoxEmployee');
    Route::post('/editar-caixa', [EmployeeController::class, 'updateBox'])->name('updateBoxEmployee');
    Route::get('/resgatar/{id}', [EmployeeController::class, 'rescue'])->name('rescueEmployee');
    Route::get('/trasferir/{id}', [EmployeeController::class, 'setTransfer'])->name('setTransferEmployee');
    Route::post('/transferir', [EmployeeController::class, 'transfer'])->name('transferEmployee');
});