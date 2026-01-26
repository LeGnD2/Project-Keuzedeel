<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/keuzedeelinformatie', function () {
    return view('keuzedeelinformatie');
});

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected route - only accessible when logged in
Route::get('/inschrijvingkeuzedeel', function () {
    if (!session()->has('user_id')) {
        return redirect()->route('login');
    }
    return view('inschrijving-keuzedeel');
})->name('inschrijving.keuzedeel');

Route::get('/layout', function () {
    return view('layout');
});