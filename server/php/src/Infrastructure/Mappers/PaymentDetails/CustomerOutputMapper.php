<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CustomerOutput as CustomerOutputDto;
use OnlinePayments\Sdk\Domain\CustomerOutput as CustomerOutputSdk;

final class CustomerOutputMapper
{
    public static function mapFromSdkResponse(?CustomerOutputSdk $response): ?CustomerOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CustomerOutputDto();
        $dto->device = CustomerDeviceOutputMapper::mapFromSdkResponse($response?->device ?? null);

        return $dto;
    }
}
