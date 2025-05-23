<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use Inertia\Inertia;

Route::get('/', [FrontendPageController::class, 'homePageView'])->name('home');
Route::get('/cars', [FrontendCarController::class, 'carPageView'])->name('cars');
Route::get('/cars/{id}/details', [FrontendCarController::class, 'carDetailsView'])->name('cars.details');
Route::get('/contact', function(){
    return Inertia::render('Frontend/Contact');
});
Route::get('/about', function(){
    return Inertia::render('Frontend/About');
});

Route::get('/register', [AuthController::class, 'registerPage'])->name('registration');
Route::post('/register', [AuthController::class, 'register'])->name('post.registration');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('page.logout');

Route::middleware(['RoleMiddleware:admin'])->group(function () {
    Route::get('/dashboard', [AdminPageController::class, 'dashboardView'])->name('dashboard');
    Route::get('/dashboard/cars', [AdminPageController::class, 'manageCars'])->name('dashboard.cars');
    Route::get('/dashboard/cars/create', [AdminCarController::class, 'createCar'])->name('dashboard.cars.create');
    Route::post('/dashboard/cars/create', [AdminCarController::class, 'saveCar'])->name('dashboard.cars.save');
    Route::get('/dashboard/cars/{id}/edit', [AdminCarController::class, 'editCar'])->name('dashboard.cars.edit');
    Route::put('/dashboard/cars/{id}/edit', [AdminCarController::class, 'updateCar'])->name('dashboard.cars.update');
    Route::delete('/dashboard/cars/{id}', [AdminCarController::class, 'deleteCar'])->name('dashboard.cars.delete');

    Route::get('/dashboard/customers', [AdminPageController::class, 'manageCustomers'])->name('dashboard.customers');
    Route::get('/dashboard/customers/{id}/details', [AdminPageController::class, 'customerDetails'])->name('dashboard.customer.details');
    Route::get('/dashboard/customers/create', [AdminCustomerController::class, 'createCustomer'])->name('dashboard.customers.create');
    Route::post('/dashboard/customers/create', [AdminCustomerController::class, 'saveCustomer'])->name('dashboard.customers.save');
    Route::get('/dashboard/customers/{id}/edit', [AdminCustomerController::class, 'editCustomer'])->name('dashboard.customers.edit');
    Route::put('/dashboard/customers/{id}/edit', [AdminCustomerController::class, 'updateCustomer'])->name('dashboard.customers.update');
    Route::delete('/dashboard/customers/{id}', [AdminCustomerController::class, 'deleteCustomer'])->name('dashboard.customers.delete');

    Route::get('/dashboard/rentals', [AdminPageController::class, 'manageRentals'])->name('dashboard.rentals');
    Route::get('/dashboard/rentals/create', [AdminRentalController::class, 'createRental'])->name('dashboard.rentals.create');
    Route::post('/dashboard/rentals/create', [AdminRentalController::class, 'saveRental'])->name('dashboard.rentals.save');
    Route::get('/dashboard/rentals/{id}/edit', [AdminRentalController::class, 'editRental'])->name('dashboard.rentals.edit');
    Route::put('/dashboard/rentals/{id}/edit', [AdminRentalController::class, 'updateRental'])->name('dashboard.rentals.update');
    Route::delete('/dashboard/rentals/{id}', [AdminRentalController::class, 'deleteRental'])->name('dashboard.rentals.delete');
});
Route::middleware(['web', 'auth', 'RoleMiddleware:customer'])->group(function () {

    Route::get('/customer/dashboard', [FrontendPageController::class, 'dashboardView'])->name('customer.dashboard');
    Route::post('/rentals/create', [FrontendRentalController::class, 'bookCar'])->name('booking.create');
    Route::post('/rentals/{id}/cancel',[FrontendRentalController::class, 'cancelRental'])->name('booking.cancel');
});
