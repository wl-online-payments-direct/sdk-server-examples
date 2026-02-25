<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\ProtectionEligibility as ProtectionEligibilityDto;
use OnlinePayments\Sdk\Domain\ProtectionEligibility as ProtectionEligibilitySdk;

final class ProtectionEligibilityMapper
{
    public static function mapFromSdkResponse(?ProtectionEligibilitySdk $response): ?ProtectionEligibilityDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new ProtectionEligibilityDto();
        $dto->eligibility = $response?->eligibility ?? null;
        $dto->type = $response?->type ?? null;

        return $dto;
    }
}
