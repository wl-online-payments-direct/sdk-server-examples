<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentOutput as PaymentOutputDto;
use OnlinePayments\Sdk\Domain\PaymentOutput as PaymentOutputSdk;

final class PaymentOutputMapper
{
    public static function mapFromSdkResponse(?PaymentOutputSdk $response): ?PaymentOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentOutputDto();
        $dto->discount = DiscountMapper::mapFromSdkResponse($response?->discount ?? null);
        $dto->amountOfMoney = AmountOfMoneyMapper::mapFromSdkResponse($response?->amountOfMoney ?? null);
        $dto->customer = CustomerOutputMapper::mapFromSdkResponse($response?->customer ?? null);
        $dto->paymentMethod = $response?->paymentMethod ?? null;
        $dto->merchantParameters = $response?->merchantParameters ?? null;
        $dto->acquiredAmount = AmountOfMoneyMapper::mapFromSdkResponse($response?->acquiredAmount ?? null);
        $dto->references = PaymentReferencesMapper::mapFromSdkResponse($response?->references ?? null);
        $dto->surchargeSpecificOutput = SurchargeSpecificOutputMapper::mapFromSdkResponse($response?->surchargeSpecificOutput ?? null);
        $dto->cardPaymentMethodSpecificOutput = CardPaymentMethodSpecificOutputMapper::mapFromSdkResponse($response?->cardPaymentMethodSpecificOutput ?? null);
        $dto->mobilePaymentMethodSpecificOutput = MobilePaymentMethodSpecificOutputMapper::mapFromSdkResponse($response?->mobilePaymentMethodSpecificOutput ?? null);
        $dto->redirectPaymentMethodSpecificOutput = RedirectPaymentMethodSpecificOutputMapper::mapFromSdkResponse($response?->redirectPaymentMethodSpecificOutput ?? null);
        $dto->sepaDirectDebitPaymentMethodSpecificOutput = SepaDirectDebitPaymentMethodSpecificOutputMapper::mapFromSdkResponse($response?->sepaDirectDebitPaymentMethodSpecificOutput ?? null);

        return $dto;
    }
}
