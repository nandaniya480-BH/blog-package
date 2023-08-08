<?php

use Illuminate\Support\Facades\Route;
use Nandaniya480\Blog\Controllers\BlogController;

Route::prefix('api')->group(function () {    
    Route::ApiResources([
        'blog' => BlogController::class,
    ]);
});
