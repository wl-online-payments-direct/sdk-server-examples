<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CustomerBankAccount as CustomerBankAccountDto;
use OnlinePayments\Sdk\Domain\CustomerBankAccount as CustomerBankAccountSdk;

final class CustomerBankAccountMapper
{
    public static function mapFromSdkResponse(?CustomerBankAccountSdk $response): ?CustomerBankAccountDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CustomerBankAccountDto();
        $dto->accountHolderName = $response?->accountHolderName ?? null;
        $dto->bic = $response?->bic ?? null;
        $dto->iban = $response?->iban ?? null;

        return $dto;
    }
}
