<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CardPaymentMethodSpecificOutput as CardPaymentMethodSpecificOutputDto;
use OnlinePayments\Sdk\Domain\CardPaymentMethodSpecificOutput as CardPaymentMethodSpecificOutputSdk;

final class CardPaymentMethodSpecificOutputMapper
{
    public static function mapFromSdkResponse(?CardPaymentMethodSpecificOutputSdk $response): ?CardPaymentMethodSpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CardPaymentMethodSpecificOutputDto();
        $dto->card = CardEssentialsMapper::mapFromSdkResponse($response?->card ?? null);
        $dto->acquirerInformation = AcquirerInformationMapper::mapFromSdkResponse($response?->acquirerInformation ?? null);
        $dto->authorisationCode = $response?->authorisationCode ?? null;
        $dto->currencyConversion = CurrencyConversionMapper::mapFromSdkResponse($response?->currencyConversion ?? null);
        $dto->authenticatedAmount = $response?->authenticatedAmount ?? null;
        $dto->fraudResults = CardFraudResultsMapper::mapFromSdkResponse($response?->fraudResults ?? null);
        $dto->paymentOption = $response?->paymentOption ?? null;
        $dto->reattemptInstructions = ReattemptInstructionsMapper::mapFromSdkResponse($response?->reattemptInstructions ?? null);
        $dto->externalTokenLinked = ExternalTokenLinkedMapper::mapFromSdkResponse($response?->externalTokenLinked ?? null);
        $dto->paymentAccountReference = $response?->paymentAccountReference ?? null;
        $dto->paymentProductId = $response?->paymentProductId ?? null;
        $dto->initialSchemeTransactionId = $response?->initialSchemeTransactionId ?? null;
        $dto->schemeReferenceData = $response?->schemeReferenceData ?? null;
        $dto->paymentProduct3208SpecificOutput = PaymentProduct3208SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct3208SpecificOutput ?? null);
        $dto->paymentProduct3209SpecificOutput = PaymentProduct3209SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct3209SpecificOutput ?? null);
        $dto->threeDSecureResults = ThreeDSecureResultsMapper::mapFromSdkResponse($response?->threeDSecureResults ?? null);
        $dto->token = $response?->token ?? null;

        return $dto;
    }
}
