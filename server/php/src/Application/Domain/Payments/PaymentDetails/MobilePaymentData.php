<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class MobilePaymentData
{
    public ?string $dpan = null;
    public ?string $expiryDate = null;

    public function toArray(): array
    {
        return [
            'dpan' => $this->dpan,
            'expiryDate' => $this->expiryDate,
        ];
    }
}
