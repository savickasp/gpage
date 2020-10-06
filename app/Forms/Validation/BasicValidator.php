<?php


namespace App\Forms\Validation;


use Illuminate\Support\Facades\Validator;

class BasicValidator extends Validator
{
    private $rules;
    private $messages;

    public function __construct(array $rules, array $messages)
    {
        $this->rules = $rules;
        $this->messages = $messages;
    }

    public function validateForm(array $data): array
    {
        return Validator::make($data, $this->rules, $this->messages)->validate();
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function extendFieldRule(string $index, string $rule): object
    {
        $this->rules[$index] .= $rule;

        return$this;
    }

    public function addMessage(string $index, string $message): object
    {
        $this->messages[$index] = $message;

        return $this;
    }
}
