<?php

namespace Application\Controllers;

class MoviesController
{
    public function index(): void
    {
        include_once APP_PATH . '/views/page/movies.php';
    }
}