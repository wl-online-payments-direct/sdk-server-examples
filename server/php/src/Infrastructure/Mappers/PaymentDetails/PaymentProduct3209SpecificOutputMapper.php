<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct3209SpecificOutput as PaymentProduct3209SpecificOutputDto;
use OnlinePayments\Sdk\Domain\PaymentProduct3209SpecificOutput as PaymentProduct3209SpecificOutputSdk;

final class PaymentProduct3209SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct3209SpecificOutputSdk $response): ?PaymentProduct3209SpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentProduct3209SpecificOutputDto();
        $dto->buyerCompliantBankMessage = $response?->buyerCompliantBankMessage ?? null;

        return $dto;
    }
}
