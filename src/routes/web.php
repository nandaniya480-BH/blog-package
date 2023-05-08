<?php

use Nandaniya480\Blog\Controllers\InspirationController;
use Illuminate\Support\Facades\Route;
use Nandaniya480\Blog\Controllers\BlogController;

Route::prefix('api')->group(function () {
    Route::get('welcome', function () {
        return view('Blog::welcome');
    });

    Route::get('justDoIt', [BlogController::class, 'justDoIt']);
    
    Route::ApiResources([
        'blog' => BlogController::class,
    ]);
});
