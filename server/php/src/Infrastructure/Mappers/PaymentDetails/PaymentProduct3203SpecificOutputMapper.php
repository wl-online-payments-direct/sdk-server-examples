<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct3203SpecificOutput as PaymentProduct3203SpecificOutputDto;
use OnlinePayments\Sdk\Domain\PaymentProduct3203SpecificOutput as PaymentProduct3203SpecificOutputSdk;

final class PaymentProduct3203SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct3203SpecificOutputSdk $response): ?PaymentProduct3203SpecificOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentProduct3203SpecificOutputDto();
        $dto->billingAddress = AddressPersonalMapper::mapFromSdkResponse($response?->billingAddress ?? null);
        $dto->shippingAddress = AddressPersonalMapper::mapFromSdkResponse($response?->shippingAddress ?? null);

        return $dto;
    }
}
