<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/edit', function () {
    return view('edit');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/add', function () {
    return view('add');
});

Route::get('/delete', function () {
    return view('delete');
});