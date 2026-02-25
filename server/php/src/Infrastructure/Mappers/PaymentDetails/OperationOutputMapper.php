<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationOutput as OperationOutputDto;
use OnlinePayments\Sdk\Domain\OperationOutput as OperationOutputSdk;

final class OperationOutputMapper
{
    public static function mapFromSdkResponse(?OperationOutputSdk $response): OperationOutputDto
    {
        $dto = new OperationOutputDto();
        $dto->id = $response?->id ?? null;
        $dto->operationReferences = OperationPaymentReferencesMapper::mapFromSdkResponse($response?->operationReferences ?? null);
        $dto->paymentMethod = $response?->paymentMethod ?? null;
        $dto->statusOutput = PaymentStatusOutputMapper::mapFromSdkResponse($response?->statusOutput ?? null);
        $dto->amountOfMoney = AmountOfMoneyMapper::mapFromSdkResponse($response?->amountOfMoney ?? null);
        $dto->references = PaymentReferencesMapper::mapFromSdkResponse($response?->references ?? null);
        $dto->status = $response?->status ?? null;

        return $dto;
    }
}
