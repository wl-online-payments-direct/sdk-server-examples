<?php

namespace OnlinePayments\ExampleApp\Configuration\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public array $errors;

    public function __construct(array $errors)
    {
        parent::__construct('Validation failed.');
        $this->errors = $errors;
    }
}
