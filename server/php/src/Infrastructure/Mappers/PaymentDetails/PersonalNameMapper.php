<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PersonalName as PersonalNameDto;
use OnlinePayments\Sdk\Domain\PersonalName as PersonalNameSdk;

final class PersonalNameMapper
{
    public static function mapFromSdkResponse(?PersonalNameSdk $response): ?PersonalNameDto
    {
        if ($response === null) {
            return null;
        }

        return new PersonalNameDto(
            firstName: $response->firstName ?? null,
            surname: $response->surname ?? null,
            title: $response->title ?? null
        );
    }
}
