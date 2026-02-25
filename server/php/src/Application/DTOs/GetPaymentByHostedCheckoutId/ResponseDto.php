<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId;

class ResponseDto
{
    public ?string $status = null;

    public ?string $paymentId = null;
}