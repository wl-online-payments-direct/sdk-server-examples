<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CardEssentials
{
    public ?string $bin = null;
    public ?string $cardNumber = null;
    public ?string $countryCode = null;
    public ?string $expiryDate = null;

    public function toArray(): array
    {
        return [
            'bin' => $this->bin,
            'cardNumber' => $this->cardNumber,
            'countryCode' => $this->countryCode,
            'expiryDate' => $this->expiryDate,
        ];
    }
}
