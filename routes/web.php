<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AppController::class, 'loginPage']);
Route::post('/login', [AppController::class, 'login']);

Route::get('/register', [AppController::class, 'registerPage']);
Route::post('/register', [AppController::class, 'register']);

Route::get('/dashboard', [AppController::class, 'dashboard']);

Route::post('/add-item', [AppController::class, 'addItem']);
Route::post('/delete-item', [AppController::class, 'deleteItem']);

Route::get('/logout', [AppController::class, 'logout']);

Route::get('/dashboard', [AppController::class, 'dashboard']);
Route::post('/add-item', [AppController::class, 'addItem']);
Route::post('/delete-item', [AppController::class, 'deleteItem']);

Route::get('/admin', [AppController::class, 'admin']);
Route::get('/manager', [AppController::class, 'manager']);
Route::get('/user', [AppController::class, 'user']);

use App\Http\Controllers\ForgotController;

Route::get('/forgot', [ForgotController::class, 'showForm']);
Route::post('/reset-password', [ForgotController::class, 'reset']);

Route::get('/forgot', [ForgotController::class, 'showForm']);

Route::get('/test-mail', [ForgotController::class, 'sendTestMail']);