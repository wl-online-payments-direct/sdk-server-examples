<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\ExternalTokenLinked as ExternalTokenLinkedDto;
use OnlinePayments\Sdk\Domain\ExternalTokenLinked as ExternalTokenLinkedSdk;

final class ExternalTokenLinkedMapper
{
    public static function mapFromSdkResponse(?ExternalTokenLinkedSdk $response): ?ExternalTokenLinkedDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new ExternalTokenLinkedDto();
        $dto->computedToken = $response?->computedToken ?? null;
        $dto->generatedToken = $response?->generatedToken ?? null;
        $dto->gtsComputedToken = $response?->gtsComputedToken ?? null;

        return $dto;
    }
}
