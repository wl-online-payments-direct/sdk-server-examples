<?php

namespace OnlinePayments\ExampleApp\Infrastructure;

use DI;
use DI\ContainerBuilder;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedCheckoutClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedTokenizationClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\MandateClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentLinkClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\ServiceClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\HostedCheckoutClient;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\HostedTokenizationClient;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\MandateClient;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\PaymentClient;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\PaymentLinkClient;
use OnlinePayments\ExampleApp\Infrastructure\SDKClients\ServiceClient;

final class DIConfiguration
{
    public static function configure(ContainerBuilder $builder): void
    {
        $builder->addDefinitions([
            HostedCheckoutClientInterface::class => DI\autowire(HostedCheckoutClient::class),
            PaymentLinkClientInterface::class   => DI\autowire(PaymentLinkClient::class),
            HostedTokenizationClientInterface::class   => DI\autowire(HostedTokenizationClient::class),
            PaymentClientInterface::class   => DI\autowire(PaymentClient::class),
            MandateClientInterface::class   => DI\autowire(MandateClient::class),
            ServiceClientInterface::class   => DI\autowire(ServiceClient::class),
        ]);
    }
}
