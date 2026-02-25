<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\Address as AddressDto;
use OnlinePayments\Sdk\Domain\Address as AddressSdk;

final class AddressMapper
{
    public static function mapFromSdkResponse(?AddressSdk $response): ?AddressDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new AddressDto();
        $dto->additionalInfo = $response?->additionalInfo ?? null;
        $dto->city = $response?->city ?? null;
        $dto->countryCode = $response?->countryCode ?? null;
        $dto->houseNumber = $response?->houseNumber ?? null;
        $dto->state = $response?->state ?? null;
        $dto->street = $response?->street ?? null;
        $dto->zip = $response?->zip ?? null;

        return $dto;
    }
}
