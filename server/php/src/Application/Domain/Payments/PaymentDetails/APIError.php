<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class APIError
{
    public ?string $category = null;
    public ?string $code = null;
    public ?string $errorCode = null;
    public ?int $httpStatusCode = null;
    public ?string $id = null;
    public ?string $message = null;
    public ?string $propertyName = null;
    public ?bool $retriable = null;
}
