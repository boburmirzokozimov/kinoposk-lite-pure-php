<?php

declare(strict_types=1);

namespace Application\Kernel\Router;

use Application\Kernel\Controller\Controller;
use Application\Kernel\Http\RedirectInterface;
use Application\Kernel\Http\RequestInterface;
use Application\Kernel\Session\SessionInterface;
use Application\Kernel\View\ViewInterface;
use JetBrains\PhpStorm\NoReturn;

class Router implements RouterInterface
{
    private array $routes = [];

    public function __construct(private readonly ViewInterface     $view,
                                private readonly RequestInterface  $request,
                                private readonly RedirectInterface $redirect,
                                private readonly SessionInterface  $session)
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

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound($uri);
        }

        if (is_array($route->getCallback())) {
            [$controller, $action] = $route->getCallback();

            /** @var Controller $controller */
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getCallback());
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    #[NoReturn] private function notFound(string $uri): void
    {
        echo "$uri Not found | 404";
        exit;
    }

}