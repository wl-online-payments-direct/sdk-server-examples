<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class OperationPaymentReferences
{
    public ?string $merchantReference = null;

    public function toArray(): array
    {
        return [
            'merchantReference' => $this->merchantReference
        ];
    }
}
