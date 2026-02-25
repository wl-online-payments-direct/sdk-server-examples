<?php

namespace OnlinePayments\ExampleApp\Application\Exceptions;

use Exception;

class SdkException extends Exception
{
    private int $statusCode;

    public function __construct(string $message, int $statusCode, ?Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}