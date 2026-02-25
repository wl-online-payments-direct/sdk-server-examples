<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\HostedCheckoutSpecificOutput as HostedCheckoutSpecificOutputDomain;
use OnlinePayments\Sdk\Domain\HostedCheckoutSpecificOutput as HostedCheckoutSpecificOutputSdk;

final class HostedCheckoutSpecificOutputMapper
{
    public static function mapFromSdkResponse(?HostedCheckoutSpecificOutputSdk $response): ?HostedCheckoutSpecificOutputDomain
    {
        if ($response === null) {
            return null;
        }

        $output = new HostedCheckoutSpecificOutputDomain();
        $output->hostedCheckoutId = $response->getHostedCheckoutId();
        $output->variant = $response->getVariant();

        return $output;
    }
}
