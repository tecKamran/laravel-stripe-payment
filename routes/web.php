<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;

// Payment Routes
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');

// Default Laravel welcome page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (only once)
Auth::routes();

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');
