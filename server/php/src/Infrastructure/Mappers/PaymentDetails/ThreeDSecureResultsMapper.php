<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\ThreeDSecureResults as ThreeDSecureResultsDto;
use OnlinePayments\Sdk\Domain\ThreeDSecureResults as ThreeDSecureResultsSdk;

final class ThreeDSecureResultsMapper
{
    public static function mapFromSdkResponse(?ThreeDSecureResultsSdk $response): ?ThreeDSecureResultsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new ThreeDSecureResultsDto();
        $dto->acsTransactionId = $response?->acsTransactionId ?? null;
        $dto->appliedExemption = $response?->appliedExemption ?? null;
        $dto->authenticationStatus = $response?->authenticationStatus ?? null;
        $dto->cavv = $response?->cavv ?? null;
        $dto->challengeIndicator = $response?->challengeIndicator ?? null;
        $dto->dsTransactionId = $response?->dsTransactionId ?? null;
        $dto->eci = $response?->eci ?? null;
        $dto->exemptionEngineFlow = $response?->exemptionEngineFlow ?? null;
        $dto->flow = $response?->flow ?? null;
        $dto->liability = $response?->liability ?? null;
        $dto->schemeEci = $response?->schemeEci ?? null;
        $dto->version = $response?->version ?? null;
        $dto->xid = $response?->xid ?? null;

        return $dto;
    }
}
