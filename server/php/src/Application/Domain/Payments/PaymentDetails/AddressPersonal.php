<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class AddressPersonal
{
    public ?string $additionalInfo = null;
    public ?string $city = null;
    public ?string $companyName = null;
    public ?string $countryCode = null;
    public ?string $houseNumber = null;
    public ?PersonalName $name = null;
    public ?string $state = null;
    public ?string $street = null;
    public ?string $zip = null;

    public function __construct(
        ?string $additionalInfo = null,
        ?string $city = null,
        ?string $companyName = null,
        ?string $countryCode = null,
        ?string $houseNumber = null,
        ?PersonalName $name = null,
        ?string $state = null,
        ?string $street = null,
        ?string $zip = null
    ) {
        $this->additionalInfo = $additionalInfo;
        $this->city = $city;
        $this->companyName = $companyName;
        $this->countryCode = $countryCode;
        $this->houseNumber = $houseNumber;
        $this->name = $name;
        $this->state = $state;
        $this->street = $street;
        $this->zip = $zip;
    }

    public function toArray(): array
    {
        return [
            'additionalInfo' => $this->additionalInfo,
            'city' => $this->city,
            'companyName' => $this->companyName,
            'countryCode' => $this->countryCode,
            'houseNumber' => $this->houseNumber,
            'name' => ($this->name ?? new PersonalName())->toArray(),
            'state' => $this->state,
            'street' => $this->street,
            'zip' => $this->zip,
        ];
    }
}
