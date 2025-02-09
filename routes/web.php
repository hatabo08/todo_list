<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('todos', TodoController::class);

Route::post('/todos/{todo}/update-description', [TodoController::class, 'updateDescription'])->name('todos.updateDescription');

