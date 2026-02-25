<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\MobilePaymentMethodSpecificOutput as MobilePaymentMethodSpecificOutputDto;
use OnlinePayments\Sdk\Domain\MobilePaymentMethodSpecificOutput as MobilePaymentMethodSpecificOutputSdk;

final class MobilePaymentMethodSpecificOutputMapper
{
    public static function mapFromSdkResponse(?MobilePaymentMethodSpecificOutputSdk $response): ?MobilePaymentMethodSpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new MobilePaymentMethodSpecificOutputDto();
        $dto->network = $response?->network ?? null;
        $dto->authorisationCode = $response?->authorisationCode ?? null;
        $dto->paymentProductId = $response?->paymentProductId ?? null;
        $dto->fraudResults = CardFraudResultsMapper::mapFromSdkResponse($response?->fraudResults);
        $dto->paymentData = MobilePaymentDataMapper::mapFromSdkResponse($response?->paymentData);
        $dto->threeDSecureResults = ThreeDSecureResultsMapper::mapFromSdkResponse($response?->threeDSecureResults);

        return $dto;
    }
}
