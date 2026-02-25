<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId;

class RequestDto
{
    private ?string $cardNumber;

    public function __construct(?string $cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(?string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }
}