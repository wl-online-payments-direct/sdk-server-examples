<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct840CustomerAccount as PaymentProduct840CustomerAccountDto;
use OnlinePayments\Sdk\Domain\PaymentProduct840CustomerAccount as PaymentProduct840CustomerAccountSdk;

final class PaymentProduct840CustomerAccountMapper
{
    public static function mapFromSdkResponse(?PaymentProduct840CustomerAccountSdk $response): ?PaymentProduct840CustomerAccountDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentProduct840CustomerAccountDto();
        $dto->accountId = $response?->accountId ?? null;
        $dto->companyName = $response?->companyName ?? null;
        $dto->countryCode = $response?->countryCode ?? null;
        $dto->firstName = $response?->firstName ?? null;
        $dto->customerAccountStatus = $response?->customerAccountStatus ?? null;
        $dto->customerAddressStatus = $response?->customerAddressStatus ?? null;
        $dto->payerId = $response?->payerId ?? null;
        $dto->surname = $response?->surname ?? null;

        return $dto;
    }
}
