<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CardFraudResults
{
    public ?string $fraudServiceResult = null;
    public ?string $avsResult = null;
    public ?string $cvvResult = null;

    public function toArray(): array
    {
        return [
            'fraudServiceResult' => $this->fraudServiceResult,
            'avsResult' => $this->avsResult,
            'cvvResult' => $this->cvvResult,
        ];
    }
}
