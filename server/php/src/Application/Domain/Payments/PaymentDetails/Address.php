<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class Address
{
    public ?string $additionalInfo = null;
    public ?string $city = null;
    public ?string $countryCode = null;
    public ?string $houseNumber = null;
    public ?string $state = null;
    public ?string $street = null;
    public ?string $zip = null;

    public function toArray(): array
    {
        return [
            'additionalInfo' => $this->additionalInfo,
            'city' => $this->city,
            'countryCode' => $this->countryCode,
            'houseNumber' => $this->houseNumber,
            'state' => $this->state,
            'street' => $this->street,
            'zip' => $this->zip,
        ];
    }
}
