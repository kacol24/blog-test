<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')
     ->group(function () {
         Route::post('posts/import', [\App\Http\Controllers\PostImportController::class, 'store'])
              ->name('posts.import');

         Route::resource('posts', \App\Http\Controllers\PostController::class);

         Route::post('logout', \App\Http\Controllers\LogoutController::class)
              ->name('logout');
     });

Route::middleware('guest')
     ->group(function () {
         Route::get('auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])
              ->name('login');

         Route::post('auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);

         Route::get('auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])
              ->name('register');

         Route::post('auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
     });
