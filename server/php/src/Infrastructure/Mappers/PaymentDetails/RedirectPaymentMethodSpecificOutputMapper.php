<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\RedirectPaymentMethodSpecificOutput as RedirectPaymentMethodSpecificOutputDto;
use OnlinePayments\Sdk\Domain\RedirectPaymentMethodSpecificOutput as RedirectPaymentMethodSpecificOutputSdk;

final class RedirectPaymentMethodSpecificOutputMapper
{
    public static function mapFromSdkResponse(?RedirectPaymentMethodSpecificOutputSdk $response): ?RedirectPaymentMethodSpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new RedirectPaymentMethodSpecificOutputDto();
        $dto->token = $response?->token ?? null;
        $dto->authorisationCode = $response?->authorisationCode ?? null;
        $dto->paymentProductId = $response?->paymentProductId ?? null;
        $dto->paymentOption = $response?->paymentOption ?? null;
        $dto->fraudResults = FraudResultsMapper::mapFromSdkResponse($response?->fraudResults);
        $dto->customerBankAccount = CustomerBankAccountMapper::mapFromSdkResponse($response?->customerBankAccount);
        $dto->paymentProduct840SpecificOutput = PaymentProduct840SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct840SpecificOutput);
        $dto->paymentProduct3203SpecificOutput = PaymentProduct3203SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct3203SpecificOutput);
        $dto->paymentProduct5001SpecificOutput = PaymentProduct5001SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct5001SpecificOutput);
        $dto->paymentProduct5402SpecificOutput = PaymentProduct5402SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct5402SpecificOutput);
        $dto->paymentProduct5500SpecificOutput = PaymentProduct5500SpecificOutputMapper::mapFromSdkResponse($response?->paymentProduct5500SpecificOutput);

        return $dto;
    }
}
