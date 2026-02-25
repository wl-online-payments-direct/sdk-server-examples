<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct3208SpecificOutput as PaymentProduct3208SpecificOutputDto;
use OnlinePayments\Sdk\Domain\PaymentProduct3208SpecificOutput as PaymentProduct3208SpecificOutputSdk;

final class PaymentProduct3208SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct3208SpecificOutputSdk $response): ?PaymentProduct3208SpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentProduct3208SpecificOutputDto();
        $dto->buyerCompliantBankMessage = $response?->buyerCompliantBankMessage ?? null;

        return $dto;
    }
}
