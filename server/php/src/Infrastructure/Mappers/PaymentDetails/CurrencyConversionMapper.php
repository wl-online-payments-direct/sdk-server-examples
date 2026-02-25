<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CurrencyConversion as CurrencyConversionDto;
use OnlinePayments\Sdk\Domain\CurrencyConversion as CurrencyConversionSdk;

final class CurrencyConversionMapper
{
    public static function mapFromSdkResponse(?CurrencyConversionSdk $response): ?CurrencyConversionDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CurrencyConversionDto();
        $dto->acceptedByUser = $response?->acceptedByUser ?? null;
        $dto->proposal = DccProposalMapper::mapFromSdkResponse($response?->proposal ?? null);

        return $dto;
    }
}
