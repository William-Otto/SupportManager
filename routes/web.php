<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CustomersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Users Routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// Dashboard Route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


// Customers Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/customers', function () {
    return Inertia::render('Customer');
})->name('customers');
Route::get('/customers', [App\Http\Controllers\CustomersController::class, 'index']);
Route::post('/customers', [App\Http\Controllers\CustomersController::class, 'store']);
Route::put('/customers/{customer}', [App\Http\Controllers\CustomersController::class, 'update']);
Route::post('/customers/{customer}', [App\Http\Controllers\CustomersController::class, 'destroy']);


// Cities Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/cities', function () {
    return Inertia::render('Cities');
})->name('cities');
Route::get('/cities', [App\Http\Controllers\CitiesController::class, 'index']);
Route::post('/cities', [App\Http\Controllers\CitiesController::class, 'store']);
Route::put('/cities/{city}', [App\Http\Controllers\CitiesController::class, 'update']);
Route::post('/cities/{city}', [App\Http\Controllers\CitiesController::class, 'destroy']);