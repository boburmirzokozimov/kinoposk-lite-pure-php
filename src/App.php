<?php

declare(strict_types=1);

namespace Application;

use Application\Kernel\Http\Request;
use Application\Kernel\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router();
        $request = Request::creatFromGlobals();

        $router->dispatch($request->uri(), $request->method());
    }
}