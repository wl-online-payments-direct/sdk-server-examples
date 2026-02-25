<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments;

class Card
{
    public ?string $number = null;
    public ?string $holderName = null;
    public ?string $verificationCode = null;
    public ?string $expiryMonth = null;
    public ?string $expiryYear = null;

    public function __construct(
        ?string $number = null,
        ?string $holderName = null,
        ?string $verificationCode = null,
        ?string $expiryMonth = null,
        ?string $expiryYear = null
    ) {
        $this->number = $number;
        $this->holderName = $holderName;
        $this->verificationCode = $verificationCode;
        $this->expiryMonth = $expiryMonth;
        $this->expiryYear = $expiryYear;
    }
}
