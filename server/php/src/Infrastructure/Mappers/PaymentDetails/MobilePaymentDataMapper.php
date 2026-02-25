<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\MobilePaymentData as MobilePaymentDataDto;
use OnlinePayments\Sdk\Domain\MobilePaymentData as MobilePaymentDataSdk;

final class MobilePaymentDataMapper
{
    public static function mapFromSdkResponse(?MobilePaymentDataSdk $response): ?MobilePaymentDataDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new MobilePaymentDataDto();
        $dto->dpan = $response?->dpan ?? null;
        $dto->expiryDate = $response?->expiryDate ?? null;

        return $dto;
    }
}
