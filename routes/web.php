<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//ログインしてる人だけindexに行くログインしてなかったらログイン画面に行く
Route::get('/', [TodoController::class, 'index'])->name('todos.index')->middleware('auth');

Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');

Route::post('/todos/store', [TodoController::class, 'store'])->name('todos.store');

Route::get('/todos/show/{todo}', [TodoController::class, 'show'])->name('todos.show');
//todosはurlの名前。{todo}はid5が入る
Route::get('/todos/edit/{todo}', [TodoController::class, 'edit'])->name('todos.edit');

Route::put('/todos/update/{todo}', [TodoController::class, 'update'])->name('todos.update');

Route::delete('/todos/delete/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');

Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');

Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

Route::post('/todos/{todo}/tags/attach', [TodoController::class, 'attachTag'])->name('todos.tags.attach');

Route::delete('/todos/{todo}/tags/{tag}', [TodoController::class, 'detachTag'])->name('todos.tags.detach');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
require __DIR__ . '/auth.php';
