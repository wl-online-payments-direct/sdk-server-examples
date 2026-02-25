<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class SurchargeRate
{
    public ?float $adValoremRate = null;
    public ?int $specificRate = null;
    public ?string $surchargeProductTypeId = null;
    public ?string $surchargeProductTypeVersion = null;

    public function toArray(): array
    {
        return [
            'adValoremRate' => $this->adValoremRate,
            'specificRate' => $this->specificRate,
            'surchargeProductTypeId' => $this->surchargeProductTypeId,
            'surchargeProductTypeVersion' => $this->surchargeProductTypeVersion,
        ];
    }
}
