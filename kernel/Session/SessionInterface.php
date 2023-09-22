<?php

namespace Application\Kernel\Session;

interface SessionInterface
{
    public function set(string $key, mixed $value): void;

    public function has(string $key): bool;

    public function getFlash(string $key, string $default = null): mixed;

    public function get(string $key, string $default = null): mixed;

    public function remove(string $key): void;

    public function destroy(): void;

}