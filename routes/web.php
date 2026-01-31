<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\InschrijvingController;
use App\Http\Controllers\KeuzedeelController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/enroll', [HomeController::class, 'enroll'])->name('enroll.keuzedeel');

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

// Admin routes (alleen voor beheerders)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/keuzedeel/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/keuzedeel', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/keuzedeel/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/keuzedeel/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/keuzedeel/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

// Protected route - only accessible when logged in
Route::get('/inschrijvingkeuzedeel', function () {
    if (!session()->has('user_id')) {
        return redirect()->route('login');
    }
    return view('home');
})->name('home');

Route::get('/layout', function () {
    return view('layout');
});

//erbij gevoegd
Route::post('/inschrijvingen', [InschrijvingController::class, 'store']);


Route::post('/inschrijven', [InschrijvingController::class, 'store'])
    ->name('enroll.keuzedeel');

Route::get('/keuzedelen', [KeuzedeelController::class, 'index'])
    ->name('keuzedelen.index');

Route::get('/home', [HomeController::class, 'index'])->name('home');
