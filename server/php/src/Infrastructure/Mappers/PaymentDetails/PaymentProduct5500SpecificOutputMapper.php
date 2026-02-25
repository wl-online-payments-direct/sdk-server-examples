<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct5500SpecificOutput;

final class PaymentProduct5500SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct5500SpecificOutput $response): ?PaymentProduct5500SpecificOutput
    {
        if ($response === null) {
            return null;
        }

        return new PaymentProduct5500SpecificOutput(
            paymentReference: $response->PaymentReference ?? null,
            paymentEndDate: $response->PaymentEndDate ?? null,
            paymentStartDate: $response->PaymentStartDate ?? null,
            entityId: $response->EntityId ?? null
        );
    }
}
