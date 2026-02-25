<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct5001SpecificOutput;

final class PaymentProduct5001SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct5001SpecificOutput $response): ?PaymentProduct5001SpecificOutput
    {
        if ($response === null) {
            return null;
        }

        return new PaymentProduct5001SpecificOutput(
            liability: $response->Liability ?? null,
            accountNumber: $response->AccountNumber ?? null,
            authorisationCode: $response->AuthorisationCode ?? null,
            operationCode: $response->OperationCode ?? null,
            mobilePhoneNumber: $response->MobilePhoneNumber ?? null
        );
    }
}
