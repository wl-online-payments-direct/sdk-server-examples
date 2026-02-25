<?php

namespace OnlinePayments\ExampleApp\Application;

use DI;
use DI\ContainerBuilder;
use OnlinePayments\ExampleApp\Application\Handlers\CreditCardPaymentHandler;
use OnlinePayments\ExampleApp\Application\Handlers\DirectDebitPaymentHandler;
use OnlinePayments\ExampleApp\Application\Handlers\TokenPaymentHandler;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedCheckoutServiceInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedTokenizationServiceInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentLinkServiceInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentServiceInterface;
use OnlinePayments\ExampleApp\Application\Services\HostedCheckoutService;
use OnlinePayments\ExampleApp\Application\Services\HostedTokenizationService;
use OnlinePayments\ExampleApp\Application\Services\PaymentLinkService;
use OnlinePayments\ExampleApp\Application\Services\PaymentService;
use Psr\Container\ContainerInterface;

final class DIConfiguration
{
    public static function configure(ContainerBuilder $builder): void
    {
        $builder->addDefinitions([
            HostedCheckoutServiceInterface::class => DI\autowire(HostedCheckoutService::class),
            PaymentLinkServiceInterface::class => DI\autowire(PaymentLinkService::class),
            HostedTokenizationServiceInterface::class => DI\autowire(HostedTokenizationService::class),

            CreditCardPaymentHandler::class => DI\autowire(CreditCardPaymentHandler::class),
            DirectDebitPaymentHandler::class => DI\autowire(DirectDebitPaymentHandler::class),
            TokenPaymentHandler::class => DI\autowire(TokenPaymentHandler::class),

            PaymentServiceInterface::class => function (ContainerInterface $c) {
                return new PaymentService(
                    $c->get(PaymentClientInterface::class),
                    [
                        $c->get(CreditCardPaymentHandler::class),
                        $c->get(DirectDebitPaymentHandler::class),
                        $c->get(TokenPaymentHandler::class),
                    ]
                );
            },
        ]);
    }
}
