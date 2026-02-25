<?php

namespace OnlinePayments\ExampleApp\Configuration\Exceptions;

class MissingCredentialsException extends \RuntimeException
{
    public function __construct(string $message = "Credentials are missing.", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
