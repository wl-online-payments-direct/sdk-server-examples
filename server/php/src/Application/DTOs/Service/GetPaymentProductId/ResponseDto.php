<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId;

class ResponseDto
{
    private ?int $paymentProductId;

    public function __construct(?int $paymentProductId)
    {
        $this->paymentProductId = $paymentProductId;
    }

    public function getPaymentProductId(): ?int
    {
        return $this->paymentProductId;
    }

    public function setPaymentProductId(?int $paymentProductId): void
    {
        $this->paymentProductId = $paymentProductId;
    }
}