<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\SurchargeRate as SurchargeRateDto;
use OnlinePayments\Sdk\Domain\SurchargeRate as SurchargeRateSdk;

final class SurchargeRateMapper
{
    public static function mapFromSdkResponse(?SurchargeRateSdk $response): ?SurchargeRateDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new SurchargeRateDto();
        $dto->specificRate = $response?->specificRate ?? null;
        $dto->adValoremRate = $response?->adValoremRate ?? null;
        $dto->surchargeProductTypeVersion = $response?->surchargeProductTypeVersion ?? null;
        $dto->surchargeProductTypeId = $response?->surchargeProductTypeId ?? null;

        return $dto;
    }
}
