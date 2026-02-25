<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class DccProposal
{
    public ?AmountOfMoney $baseAmount = null;
    public ?string $disclaimerDisplay = null;
    public ?string $disclaimerReceipt = null;
    public ?RateDetails $rate = null;
    public ?AmountOfMoney $targetAmount = null;

    public function toArray(): array
    {
        return [
            'baseAmount' => ($this->baseAmount ?? new AmountOfMoney())->toArray(),
            'disclaimerDisplay' => $this->disclaimerDisplay,
            'disclaimerReceipt' => $this->disclaimerReceipt,
            'rate' => ($this->rate ?? new RateDetails())->toArray(),
            'targetAmount' => ($this->targetAmount ?? new AmountOfMoney())->toArray(),
        ];
    }
}
