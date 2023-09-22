<?php

namespace Application\Kernel\View;

use Application\Kernel\Exceptions\ViewNotFoundException;
use Application\Kernel\Session\SessionInterface;
use Exception;

readonly class View implements ViewInterface
{
    public function __construct(private SessionInterface $session)
    {
    }

    /**
     * @throws Exception
     */
    public function page(string $path): void
    {
        if (!file_exists($viewPath = APP_PATH . "/views/page/$path.php")) {
            throw new ViewNotFoundException("Could not find $path in directory");
        }

        extract($this->extractData());

        include_once $viewPath;
    }

    private function extractData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session
        ];
    }

    public function component(string $path): void
    {
        if (!file_exists($componentPath = APP_PATH . "/views/components/$path.php")) {
            echo "Component $path not found";
            return;
        }

        include_once $componentPath;
    }
}