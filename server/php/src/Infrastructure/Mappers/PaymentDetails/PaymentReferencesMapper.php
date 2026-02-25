<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentReferences as PaymentReferencesDto;
use OnlinePayments\Sdk\Domain\PaymentReferences as PaymentReferencesSdk;

final class PaymentReferencesMapper
{
    public static function mapFromSdkResponse(?PaymentReferencesSdk $response): ?PaymentReferencesDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentReferencesDto();
        $dto->merchantParameters = $response?->merchantParameters ?? null;
        $dto->merchantReference = $response?->merchantReference ?? null;

        return $dto;
    }
}
