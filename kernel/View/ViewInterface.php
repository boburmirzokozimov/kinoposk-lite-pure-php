<?php

namespace Application\Kernel\View;

interface ViewInterface
{
    public function page(string $path): void;

    public function component(string $path): void;
}