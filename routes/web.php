<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PageController as AdminPageController;

Route::get('/', function () {
    return inertia('Home');
});

Route::get('/login',[AuthController::class, 'loginPage'])->name('page.login');
Route::post('/login',[AuthController::class, 'login'])->name('post.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('page.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[AdminPageController::class, 'dashboardView'])->name('page.dashboard');
});