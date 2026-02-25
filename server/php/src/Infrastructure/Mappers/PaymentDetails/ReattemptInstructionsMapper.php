<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\ReattemptInstructions as ReattemptInstructionsDto;
use OnlinePayments\Sdk\Domain\ReattemptInstructions as ReattemptInstructionsSdk;

final class ReattemptInstructionsMapper
{
    public static function mapFromSdkResponse(?ReattemptInstructionsSdk $response): ?ReattemptInstructionsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new ReattemptInstructionsDto();
        $dto->conditions = ReattemptInstructionsConditionsMapper::mapFromSdkResponse($response?->conditions ?? null);
        $dto->frozenPeriod = $response?->frozenPeriod ?? null;
        $dto->indicator = $response?->indicator ?? null;

        return $dto;
    }
}
