<?php

declare(strict_types=1);

namespace Application\Kernel\Router;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->initRoutes();
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

    public function dispatch(string $path, string $method): void
    {
        $route = $this->findRoute($path, $method);

        if (!$route) {
            $this->notFound($path);
        }

        if (is_array($route->getCallback())) {
            [$controller, $action] = $route->getCallback();

            $controller = new $controller();

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getCallback());
        }
    }

    private function findRoute(string $path, string $method): Route|false
    {
        if (!isset($this->routes[$method][$path])) {
            return false;
        }
        return $this->routes[$method][$path];
    }

    #[NoReturn] private function notFound(string $path): void
    {
        echo "$path Not found | 404";
        exit;
    }

}