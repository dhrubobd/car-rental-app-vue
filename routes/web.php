<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;

Route::get('/', function () {
    return inertia('Home');
});

Route::get('/login',[AuthController::class, 'loginPage'])->name('login');
Route::post('/login',[AuthController::class, 'login'])->name('post.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('page.logout');

Route::middleware(['RoleMiddleware:admin'])->group(function () {
    Route::get('/dashboard',[AdminPageController::class, 'dashboardView'])->name('dashboard');
    Route::get('/dashboard/cars',[AdminPageController::class, 'carData'])->name('dashboard.cars');
    Route::get('/dashboard/cars/create',[AdminCarController::class, 'createCar'])->name('dashboard.cars.create');
    Route::post('/dashboard/cars/create',[AdminCarController::class, 'saveCar'])->name('dashboard.cars.save');
    Route::delete('/dashboard/cars/{id}',[AdminCarController::class, 'deleteCar'])->name('dashboard.cars.delete');

});
Route::middleware(['web','auth','RoleMiddleware:customer'])->group(function () {
    Route::get('/customer/manage-booking',[FrontendPageController::class, 'manageBookingView'])->name('page.manage-booking');
});