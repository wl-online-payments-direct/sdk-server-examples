<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationPaymentReferences as OperationPaymentReferencesDto;
use OnlinePayments\Sdk\Domain\OperationPaymentReferences as OperationPaymentReferencesSdk;

final class OperationPaymentReferencesMapper
{
    public static function mapFromSdkResponse(?OperationPaymentReferencesSdk $response): OperationPaymentReferencesDto
    {
        $dto = new OperationPaymentReferencesDto();
        $dto->merchantReference = $response?->merchantReference ?? null;

        return $dto;
    }
}
