<?php

use Application\Controllers\HomeController;
use Application\Controllers\MoviesController;
use Application\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviesController::class, 'index']),
];