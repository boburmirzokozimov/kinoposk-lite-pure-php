<?php

namespace Application\Kernel\Router;

class Route
{
    public function __construct(
        private readonly string $uri,
        private readonly string $method,
        private                 $callback
    )
    {
    }

    public static function get(string $uri, $callback): static
    {
        return new static($uri, 'GET', $callback);
    }

    public static function post(string $uri, $callback): static
    {
        return new static($uri, 'POST', $callback);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getCallback()
    {
        return $this->callback;
    }
}