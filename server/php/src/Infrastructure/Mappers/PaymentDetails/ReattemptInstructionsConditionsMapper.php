<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\ReattemptInstructionsConditions as ReattemptInstructionsConditionsDto;
use OnlinePayments\Sdk\Domain\ReattemptInstructionsConditions as ReattemptInstructionsConditionsSdk;

final class ReattemptInstructionsConditionsMapper
{
    public static function mapFromSdkResponse(?ReattemptInstructionsConditionsSdk $response): ?ReattemptInstructionsConditionsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new ReattemptInstructionsConditionsDto();
        $dto->maxAttempts = $response?->maxAttempts ?? null;
        $dto->maxDelay = $response?->maxDelay ?? null;

        return $dto;
    }
}
