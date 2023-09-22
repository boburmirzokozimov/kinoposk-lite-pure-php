<?php

namespace Application\Kernel\Validator;

interface ValidatorInterface
{
    public function validate($data, $rules): bool;

    public function errors();

    public function isEmpty(): bool;
}