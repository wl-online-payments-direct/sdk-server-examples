<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\GetPaymentByHostedCheckoutId;

use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

final class Response implements ResponseInterface
{
    public ?string $status = null;

    public ?string $paymentId = null;

    public function toArray(): array
    {
        return [
            "status" => $this->status,
            "paymentId" => $this->paymentId
        ];
    }
}