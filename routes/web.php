<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mijnview', function () {
    return view('mijnview');
});

Route::get('/aboutme', function () {
    return view('aboutMe');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/home', function () {
    return view('home');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::get('/login', function () {
    return view('login');
});