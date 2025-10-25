<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('posts/import', [\App\Http\Controllers\PostImportController::class, 'store'])
     ->name('posts.import');

Route::resource('posts', \App\Http\Controllers\PostController::class);

