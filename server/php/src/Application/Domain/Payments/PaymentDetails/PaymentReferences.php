<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentReferences
{
    public ?string $merchantReference = null;
    public ?string $merchantParameters = null;

    public function toArray(): array
    {
        return [
            'merchantReference' => $this->merchantReference,
            'merchantParameters' => $this->merchantParameters,
        ];
    }
}
