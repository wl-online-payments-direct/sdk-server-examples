<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class AmountOfMoney
{
    public ?int $amount = null;
    public ?string $currencyCode = null;

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currencyCode' => $this->currencyCode,
        ];
    }
}
