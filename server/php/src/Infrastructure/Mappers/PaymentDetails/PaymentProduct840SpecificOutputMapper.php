<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct840SpecificOutput as PaymentProduct840SpecificOutputDto;
use OnlinePayments\Sdk\Domain\PaymentProduct840SpecificOutput as PaymentProduct840SpecificOutputSdk;

final class PaymentProduct840SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct840SpecificOutputSdk $response): ?PaymentProduct840SpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentProduct840SpecificOutputDto();
        $dto->billingAddress = AddressMapper::mapFromSdkResponse($response?->billingAddress ?? null);
        $dto->customerAccount = PaymentProduct840CustomerAccountMapper::mapFromSdkResponse($response?->customerAccount ?? null);
        $dto->customerAddress = AddressMapper::mapFromSdkResponse($response?->customerAddress ?? null);
        $dto->protectionEligibility = ProtectionEligibilityMapper::mapFromSdkResponse($response?->protectionEligibility ?? null);

        return $dto;
    }
}
