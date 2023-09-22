<?php

use Application\Controllers\Admin\MoviesController as AdminMoviesController;
use Application\Controllers\HomeController;
use Application\Controllers\MoviesController;
use Application\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviesController::class, 'index']),
    Route::get('/admin/movies/create', [AdminMoviesController::class, 'create']),
    Route::post('/admin/movies/create', [AdminMoviesController::class, 'store']),
];