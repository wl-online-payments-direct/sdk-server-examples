<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\FraudResults as FraudResultsDto;
use OnlinePayments\Sdk\Domain\FraudResults as FraudResultsSdk;

final class FraudResultsMapper
{
    public static function mapFromSdkResponse(?FraudResultsSdk $response): ?FraudResultsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new FraudResultsDto();
        $dto->fraudServiceResult = $response?->fraudServiceResult ?? null;

        return $dto;
    }
}
