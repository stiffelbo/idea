<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'ideas');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

//Ideas
Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth')->name('idea');
Route::get('/ideas/create', [IdeaController::class, 'create'])->middleware('auth')->name('idea.create');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth')->name('idea.store');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->middleware('auth')->name('idea.show');
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->middleware('auth')->name('idea.edit');
Route::patch('/ideas/{idea}', [IdeaController::class, 'update'])->middleware('auth')->name('idea.update');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->middleware('auth')->name('idea.destroy');
