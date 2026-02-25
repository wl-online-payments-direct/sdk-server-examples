<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\RateDetails as RateDetailsDto;
use OnlinePayments\Sdk\Domain\RateDetails as RateDetailsSdk;

final class RateDetailsMapper
{
    public static function mapFromSdkResponse(?RateDetailsSdk $response): ?RateDetailsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new RateDetailsDto();
        $dto->source = $response?->source ?? null;
        $dto->exchangeRate = $response?->exchangeRate ?? null;
        $dto->invertedExchangeRate = $response?->invertedExchangeRate ?? null;
        $dto->markUpRate = $response?->markUpRate ?? null;
        $dto->quotationDateTime = $response?->quotationDateTime ?? null;

        return $dto;
    }
}
