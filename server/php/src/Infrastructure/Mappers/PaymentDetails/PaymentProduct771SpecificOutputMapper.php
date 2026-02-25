<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentProduct771SpecificOutput;

final class PaymentProduct771SpecificOutputMapper
{
    public static function mapFromSdkResponse(?PaymentProduct771SpecificOutput $response): ?PaymentProduct771SpecificOutput
    {
        if ($response === null) {
            return null;
        }

        return new PaymentProduct771SpecificOutput(
            mandateReference: $response->MandateReference ?? null
        );
    }
}
