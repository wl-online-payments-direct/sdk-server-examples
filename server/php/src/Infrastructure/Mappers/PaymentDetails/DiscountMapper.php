<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\Discount as DiscountDto;
use OnlinePayments\Sdk\Domain\Discount as DiscountSdk;

final class DiscountMapper
{
    public static function mapFromSdkResponse(?DiscountSdk $response): ?DiscountDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new DiscountDto();
        $dto->amount = $response?->amount ?? null;

        return $dto;
    }
}
