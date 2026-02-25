<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CustomerDeviceOutput as CustomerDeviceOutputDto;
use OnlinePayments\Sdk\Domain\CustomerDeviceOutput as CustomerDeviceOutputSdk;

final class CustomerDeviceOutputMapper
{
    public static function mapFromSdkResponse(?CustomerDeviceOutputSdk $response): ?CustomerDeviceOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CustomerDeviceOutputDto();
        $dto->ipAddressCountryCode = $response?->ipAddressCountryCode ?? null;

        return $dto;
    }
}
