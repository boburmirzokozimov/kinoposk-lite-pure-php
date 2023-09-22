<?php

namespace Application\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data = [];
    private array $validated = [];

    public function validate($data, $rules): bool
    {
        $this->data = $data;

        foreach ($rules as $key => $rule) {
            $rules = explode('|', $rule);

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validateRule($key, $ruleName, $ruleValue);
                if ($error) {
                    $this->errors[$key][] = $error;
                } else {
                    $this->validated[$key] = $this->data[$key];
                }

            }
        }
        return empty($this->errors);
    }

    private function validateRule(string $key, string $ruleName, ?string $ruleValue): false|string
    {
        $value = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (!$value) {
                    return "Field $key is required";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Field $key must be at least $ruleValue characters long";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "Field $key must be at no more than $ruleValue characters long";
                }
                break;
        }

        return false;
    }

    public function validated(): array
    {
        return $this->validated;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function isEmpty(): bool
    {
        return empty($this->errors);
    }
}