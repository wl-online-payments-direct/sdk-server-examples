<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\Errors;

use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

final class ValidationErrorResponse implements ResponseInterface
{
    public ?string $message;

    public function __construct(?string $message = null)
    {
        $this->message = $message;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
