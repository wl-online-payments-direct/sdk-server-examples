<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class SurchargeSpecificOutput
{
    public ?string $mode = null;
    public ?AmountOfMoney $surchargeAmount = null;
    public ?SurchargeRate $surchargeRate = null;

    public function toArray(): array
    {
        return [
            'mode' => $this->mode,
            'surchargeAmount' => ($this->surchargeAmount ?? new AmountOfMoney())->toArray(),
            'surchargeRate' => ($this->surchargeRate ?? new SurchargeRate())->toArray(),
        ];
    }
}
