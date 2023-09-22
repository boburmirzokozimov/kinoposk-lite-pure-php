<?php

namespace Application\Kernel\Http;

use Application\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface
{
    public ValidatorInterface $validator;

    public function __construct(
        public array $get,
        public array $post,
        public array $server,
        public array $files,
        public array $cookies,
    )
    {
    }

    public static function creatFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE,
        );
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function post(): array
    {
        return $this->post;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validated(array $rules): array
    {
        if ($this->validate($rules)) {
            return $this->validator->validated();
        }
        return $this->validator->errors();
    }

    public function validate(array $rules): bool
    {
        $bag = [];

        foreach ($rules as $field => $rule) {
            $bag[$field] = $this->input($field);
        }

        return $this->validator->validate($bag, $rules);
    }

    public function input(string $name, string $default = null): ?string
    {
        return $this->post[$name] ?? $this->get[$name] ?? $default;
    }

    public function errors(): array
    {
        return $this->validator->errors();
    }

    public function all(): array
    {
        return $this->post;
    }

    public function passes(): bool
    {
        return $this->validator->isEmpty();
    }
}