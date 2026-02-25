<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Common;

class AddressDto
{
    public ?string $firstName;
    public ?string $lastName;
    public ?string $country;
    public ?string $zip;
    public ?string $city;
    public ?string $street;

    public function __construct(
        ?string $firstName,
        ?string $lastName,
        ?string $country,
        ?string $zip,
        ?string $city,
        ?string $street
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->country = $country;
        $this->zip = $zip;
        $this->city = $city;
        $this->street = $street;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['firstName'] ?? null,
            $data['lastName'] ?? null,
            $data['country'] ?? null,
            $data['zip'] ?? null,
            $data['city'] ?? null,
            $data['street'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'country' => $this->country,
            'zip' => $this->zip,
            'city' => $this->city,
            'street' => $this->street,
        ];
    }
}
