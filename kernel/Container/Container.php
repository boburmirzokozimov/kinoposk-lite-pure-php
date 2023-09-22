<?php

namespace Application\Kernel\Container;

use Application\Kernel\Http\Redirect;
use Application\Kernel\Http\RedirectInterface;
use Application\Kernel\Http\Request;
use Application\Kernel\Http\RequestInterface;
use Application\Kernel\Router\Router;
use Application\Kernel\Router\RouterInterface;
use Application\Kernel\Session\Session;
use Application\Kernel\Session\SessionInterface;
use Application\Kernel\Validator\Validator;
use Application\Kernel\Validator\ValidatorInterface;
use Application\Kernel\View\View;
use Application\Kernel\View\ViewInterface;


readonly class Container
{
    public RouterInterface $router;
    public RequestInterface $request;
    public ViewInterface $view;
    public ValidatorInterface $validator;
    public RedirectInterface $redirect;
    public SessionInterface $session;

    public function __construct()
    {
        $this->registerServices();
    }

    public function registerServices(): void
    {
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->validator = new Validator();
        $this->redirect = new Redirect();
        $this->request = Request::creatFromGlobals();
        $this->request->setValidator(
            $this->validator
        );
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->redirect,
            $this->session
        );
    }
}