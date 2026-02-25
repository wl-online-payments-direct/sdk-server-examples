<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class Discount
{
    public ?int $amount = null;

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
        ];
    }
}
