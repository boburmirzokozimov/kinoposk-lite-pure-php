<?php

namespace Application\Kernel\Controller;

use Application\Kernel\Http\RedirectInterface;
use Application\Kernel\Http\RequestInterface;
use Application\Kernel\Session\SessionInterface;
use Application\Kernel\Validator\ValidatorInterface;
use Application\Kernel\View\ViewInterface;
use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private ValidatorInterface $validator;
    private RedirectInterface $redirect;
    private SessionInterface $session;

    public function view(string $path): void
    {
        $this->view->page($path);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    #[NoReturn] public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }
}