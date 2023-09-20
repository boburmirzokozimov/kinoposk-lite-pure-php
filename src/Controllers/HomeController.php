<?php

namespace Application\Controllers;

class HomeController
{
    public function index(): void
    {
        include_once APP_PATH . '/views/page/home.php';
    }
}