<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct5402SpecificOutput;

final class PaymentProduct5402SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct5402SpecificOutput $response): ?PaymentProduct5402SpecificOutput
    {
        if ($response === null) {
            return null;
        }

        return new PaymentProduct5402SpecificOutput(
            brand: $response->Brand ?? null
        );
    }
}
