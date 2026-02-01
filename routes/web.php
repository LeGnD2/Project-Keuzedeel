<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InschrijvingController;
use App\Http\Controllers\KeuzedeelController;

/*
|--------------------------------------------------------------------------
| Publieke routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Inschrijven (VOL = VOL)
|--------------------------------------------------------------------------
*/

Route::post('/enroll', [HomeController::class, 'enroll'])
    ->name('enroll.keuzedeel');

/*
|--------------------------------------------------------------------------
| VOL pagina
|--------------------------------------------------------------------------
*/

Route::get('/vol', function () {
    return view('vol');
})->name('vol');

/*
|--------------------------------------------------------------------------
| Keuzedelen
|--------------------------------------------------------------------------
*/

Route::get('/keuzedelen', [KeuzedeelController::class, 'index'])
    ->name('keuzedelen.index');

Route::get('/keuzedeelinformatie', function () {
    return view('keuzedeelinformatie');
});

/*
|--------------------------------------------------------------------------
| Registratie & Login
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin routes (beheerder)
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/admin/keuzedeel/create', [AdminController::class, 'create'])
    ->name('admin.create');

Route::post('/admin/keuzedeel', [AdminController::class, 'store'])
    ->name('admin.store');

Route::get('/admin/keuzedeel/{id}/edit', [AdminController::class, 'edit'])
    ->name('admin.edit');

Route::put('/admin/keuzedeel/{id}', [AdminController::class, 'update'])
    ->name('admin.update');

Route::delete('/admin/keuzedeel/{id}', [AdminController::class, 'destroy'])
    ->name('admin.destroy');

/*
|--------------------------------------------------------------------------
| Test / layout
|--------------------------------------------------------------------------
*/

Route::get('/layout', function () {
    return view('layout');
});
