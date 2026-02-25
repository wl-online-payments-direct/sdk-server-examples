<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class RateDetails
{
    public ?float $exchangeRate = null;
    public ?float $invertedExchangeRate = null;
    public ?float $markUpRate = null;
    public ?string $quotationDateTime = null;
    public ?string $source = null;

    public function toArray(): array
    {
        return [
            'exchangeRate' => $this->exchangeRate,
            'invertedExchangeRate' => $this->invertedExchangeRate,
            'markUpRate' => $this->markUpRate,
            'quotationDateTime' => $this->quotationDateTime,
            'source' => $this->source,
        ];
    }
}
