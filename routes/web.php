<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return inertia('Home');
});

Route::get('/login',[AuthController::class, 'loginPage'])->name('page.login');
Route::post('/login',[AuthController::class, 'login'])->name('post.login');