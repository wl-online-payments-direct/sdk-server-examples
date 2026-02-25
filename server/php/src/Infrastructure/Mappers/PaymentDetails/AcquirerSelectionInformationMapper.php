<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\AcquirerSelectionInformation as AcquirerSelectionInformationDto;
use OnlinePayments\Sdk\Domain\AcquirerSelectionInformation as AcquirerSelectionInformationSdk;

final class AcquirerSelectionInformationMapper
{
    public static function mapFromSdkResponse(?AcquirerSelectionInformationSdk $response): ?AcquirerSelectionInformationDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new AcquirerSelectionInformationDto();
        $dto->fallbackLevel = $response?->fallbackLevel ?? null;
        $dto->ruleName = $response?->ruleName ?? null;
        $dto->result = $response?->result ?? null;

        return $dto;
    }
}
