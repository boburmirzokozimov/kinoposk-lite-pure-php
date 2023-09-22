<?php

namespace Application\Controllers;

use Application\Kernel\Controller\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home');
    }
}