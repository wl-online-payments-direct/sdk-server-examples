<?php

namespace OnlinePayments\ExampleApp\Presentation;

use DI;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use OnlinePayments\ExampleApp\Configuration\DIConfiguration as CoreDI;
use OnlinePayments\ExampleApp\Presentation\Controllers\HostedCheckoutController;
use OnlinePayments\ExampleApp\Presentation\Controllers\HostedTokenizationController;
use OnlinePayments\ExampleApp\Presentation\Controllers\PaymentController;
use OnlinePayments\ExampleApp\Presentation\Controllers\PaymentLinkController;
use OnlinePayments\ExampleApp\Presentation\Middleware\GlobalExceptionMiddleware;
use OnlinePayments\ExampleApp\Presentation\Validators\Payment\PaymentValidator;
use OnlinePayments\ExampleApp\Presentation\Validators\HostedCheckout\HostedCheckoutValidator;
use OnlinePayments\ExampleApp\Presentation\Validators\PaymentLink\PaymentLinkValidator;
use Psr\Log\LoggerInterface;

class DIConfiguration
{
    public static function configure(ContainerBuilder $builder, string $projectRoot): void
    {
        $coreDI = new CoreDI($projectRoot);
        $coreDI->configure($builder);

        $builder->addDefinitions([

            LoggerInterface::class => DI\factory(function () {
                $logger = new Logger('app');
                $logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));
                return $logger;
            }),

            HostedCheckoutValidator::class => DI\autowire(),
            PaymentLinkValidator::class    => DI\autowire(),
            PaymentValidator::class    => DI\autowire(),

            HostedCheckoutController::class => DI\autowire(),
            PaymentLinkController::class    => DI\autowire(),
            HostedTokenizationController::class => DI\autowire(),
            PaymentController::class => DI\autowire(),

            GlobalExceptionMiddleware::class => DI\autowire(),
        ]);
    }
}
