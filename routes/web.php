<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TodoController::class, 'index'])->name('todos.index');

Route::get('/todos/create',[TodoController::class,'create'])->name('todos.create');

Route::post('/todos/store',[TodoController::class,'store'])->name('todos.store');

Route::get('/todos/show/{todo}',[TodoController::class,'show'])->name('todos.show');

Route::get('/todos/edit/{todo}',[TodoController::class,'edit'])->name('todos.edit');

Route::put('/todos/update/{todo}',[TodoController::class,'update'])->name('todos.update');

Route::delete('/todos/delete/{todo}',[TodoController::class,'destroy'])->name('todos.destroy');






