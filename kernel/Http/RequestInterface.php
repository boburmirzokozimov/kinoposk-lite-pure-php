<?php

namespace Application\Kernel\Http;


use Application\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function creatFromGlobals(): static;

    public function uri(): string;

    public function method(): string;

    public function post(): array;

    public function setValidator(ValidatorInterface $validator): void;

    public function validated(array $rules): array;

    public function validate(array $rules): bool;

    public function input(string $name, string $default = null): ?string;

    public function errors(): array;

    public function all(): array;

    public function passes(): bool;

}