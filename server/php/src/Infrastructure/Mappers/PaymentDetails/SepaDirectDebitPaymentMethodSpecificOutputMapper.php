<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\SepaDirectDebitPaymentMethodSpecificOutput;

final class SepaDirectDebitPaymentMethodSpecificOutputMapper
{
    public static function mapFromSdkResponse(?SepaDirectDebitPaymentMethodSpecificOutput $response): ?SepaDirectDebitPaymentMethodSpecificOutput
    {
        if ($response === null) {
            return null;
        }

        return new SepaDirectDebitPaymentMethodSpecificOutput(
            paymentProductId: $response->PaymentProductId ?? null,
            fraudResults: FraudResultsMapper::mapFromSdkResponse($response->FraudResults ?? null),
            paymentProduct771SpecificOutput: PaymentProduct771SpecificOutputMapper::mapFromSdkResponse($response->PaymentProduct771SpecificOutput ?? null)
        );
    }
}
