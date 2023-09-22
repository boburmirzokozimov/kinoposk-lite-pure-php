<?php

namespace Application\Kernel\Http;

interface RedirectInterface
{
    public function to(string $url): void;
}