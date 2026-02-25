<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\SurchargeSpecificOutput as SurchargeSpecificOutputDto;
use OnlinePayments\Sdk\Domain\SurchargeSpecificOutput as SurchargeSpecificOutputSdk;

final class SurchargeSpecificOutputMapper
{
    public static function mapFromSdkResponse(?SurchargeSpecificOutputSdk $response): ?SurchargeSpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new SurchargeSpecificOutputDto();
        $dto->surchargeRate = SurchargeRateMapper::mapFromSdkResponse($response?->surchargeRate ?? null);
        $dto->surchargeAmount = AmountOfMoneyMapper::mapFromSdkResponse($response?->surchargeAmount ?? null);
        $dto->mode = $response?->mode ?? null;

        return $dto;
    }
}
