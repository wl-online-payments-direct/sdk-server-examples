<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\AddressPersonal as AddressPersonalDto;
use OnlinePayments\Sdk\Domain\AddressPersonal as AddressPersonalSdk;

final class AddressPersonalMapper
{
    public static function mapFromSdkResponse(?AddressPersonalSdk $response): ?AddressPersonalDto
    {
        if ($response === null) {
            return null;
        }

        return new AddressPersonalDto(
            additionalInfo: $response->additionalInfo ?? null,
            city: $response->city ?? null,
            companyName: $response->companyName ?? null,
            countryCode: $response->countryCode ?? null,
            houseNumber: $response->houseNumber ?? null,
            name: PersonalNameMapper::mapFromSdkResponse($response->name ?? null),
            state: $response->state ?? null,
            street: $response->street ?? null,
            zip: $response->zip ?? null
        );
    }
}
