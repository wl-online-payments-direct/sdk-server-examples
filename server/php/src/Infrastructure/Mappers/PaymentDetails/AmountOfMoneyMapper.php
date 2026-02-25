<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\AmountOfMoney as AmountOfMoneyDto;
use OnlinePayments\Sdk\Domain\AmountOfMoney as AmountOfMoneySdk;

final class AmountOfMoneyMapper
{
    public static function mapFromSdkResponse(?AmountOfMoneySdk $response): ?AmountOfMoneyDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new AmountOfMoneyDto();
        $dto->amount = $response?->amount ?? null;
        $dto->currencyCode = $response?->currencyCode ?? null;

        return $dto;
    }
}
