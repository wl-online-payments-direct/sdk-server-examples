<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class FraudResults
{
    public ?string $fraudServiceResult = null;

    public function toArray(): array
    {
        return [
            'fraudServiceResult' => $this->fraudServiceResult,
        ];
    }
}
