<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\AcquirerInformation as AcquirerInformationDto;
use OnlinePayments\Sdk\Domain\AcquirerInformation as AcquirerInformationSdk;

final class AcquirerInformationMapper
{
    public static function mapFromSdkResponse(?AcquirerInformationSdk $response): ?AcquirerInformationDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new AcquirerInformationDto();
        $dto->acquirerSelectionInformation = AcquirerSelectionInformationMapper::mapFromSdkResponse($response?->acquirerSelectionInformation ?? null);
        $dto->name = $response?->name ?? null;

        return $dto;
    }
}
