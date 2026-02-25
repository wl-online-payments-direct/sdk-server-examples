<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CardFraudResults as CardFraudResultsDto;
use OnlinePayments\Sdk\Domain\CardFraudResults as CardFraudResultsSdk;

final class CardFraudResultsMapper
{
    public static function mapFromSdkResponse(?CardFraudResultsSdk $response): ?CardFraudResultsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CardFraudResultsDto();
        $dto->avsResult = $response?->avsResult ?? null;
        $dto->fraudServiceResult = $response?->fraudServiceResult ?? null;
        $dto->cvvResult = $response?->cvvResult ?? null;

        return $dto;
    }
}
