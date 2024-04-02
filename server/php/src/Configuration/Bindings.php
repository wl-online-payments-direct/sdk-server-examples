<?php
namespace MyApp\Configuration;

use MyApp\HostedCheckout\HostedCheckoutController;
use MyApp\HostedCheckout\HostedCheckoutMapper;
use MyApp\HostedCheckout\HostedCheckoutService;
use MyApp\HostedTokenization\HostedTokenizationController;
use MyApp\HostedTokenization\HostedTokenizationMapper;
use MyApp\HostedTokenization\HostedTokenizationService;
use MyApp\Payment\CreatePaymentController;
use MyApp\Payment\CreatePaymentMapper;
use DI\Container;
use MyApp\Payment\CreatePaymentService;
use MyApp\Payment\PaymentDetailsService;
use OnlinePayments\Sdk\ClientInterface;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;
use Psr\Container\ContainerInterface;

/**
 * Bindings class for handling the DI
 */
class Bindings 
{
    public static function createBindings(Container $container)
    {
        // Configuration bindings
        $container->set('merchantId', $_ENV['MERCHANT_ID']);
        $container->set('apiKey', $_ENV['API_KEY']);
        $container->set('apiSecret', $_ENV['API_SECRET']);
        $container->set('apiEndpoint', $_ENV['API_ENDPOINT']);

        // $message = '>>> '.$_ENV['API_ENDPOINT'];
        // $message .= PHP_EOL;
        // error_log($message, 3, 'test.log');

        // Merchant Client configuration bindings
        $container->set(MerchantClientConfig::class, function(ContainerInterface $container) {
            return new MerchantClientConfig(
                $container->get('merchantId'),
                $container->get('apiKey'),
                $container->get('apiSecret'),
                $container->get('apiEndpoint')
            );
        });

        $merchantClientConfig = $container->get(MerchantClientConfig::class);
        $communicatorConfiguration = $merchantClientConfig->communicatorConfiguration();
        $client = $merchantClientConfig->client($communicatorConfiguration);
        $merchantClient = $merchantClientConfig->merchantClient($client);

        $container->set(ClientInterface::class, $client);
        $container->set(MerchantClientInterface::class, $merchantClient);

        // Create Payment bindings
        $container->set(CreatePaymentMapper::class, function(ContainerInterface $container) {
            return new CreatePaymentMapper();
        });

        $container->set(PaymentDetailsService::class, function(ContainerInterface $container) {
            return new PaymentDetailsService($container->get(MerchantClientInterface::class));
        });

        $container->set(CreatePaymentService::class, function(ContainerInterface $container) {
            return new CreatePaymentService($container->get(MerchantClientInterface::class));
        });

        $container->set(CreatePaymentController::class, function(ContainerInterface $container) {
            $mapper = $container->get(CreatePaymentMapper::class);
            $paymentDetailsService = $container->get(PaymentDetailsService::class);
            $createPaymentService = $container->get(CreatePaymentService::class);
            return new CreatePaymentController($mapper, $createPaymentService, $paymentDetailsService);
        });

        // Hosted tokenization bindings
        $container->set(HostedTokenizationMapper::class, function(ContainerInterface $container) {
            return new HostedTokenizationMapper();
        });

        $container->set(HostedTokenizationService::class, function(ContainerInterface $container) {
            return new HostedTokenizationService($container->get(MerchantClientInterface::class));
        });

        $container->set(HostedTokenizationController::class, function(ContainerInterface $container) {
            $mapper = $container->get(HostedTokenizationMapper::class);
            $hostedTokenizationService = $container->get(HostedTokenizationService::class);
            $paymentDetailsService = $container->get(PaymentDetailsService::class);
            $createPaymentService = $container->get(CreatePaymentService::class);
            return new HostedTokenizationController($mapper, $hostedTokenizationService, $createPaymentService, $paymentDetailsService);
        });

        // Hosted checkout bindings
        $container->set(HostedCheckoutMapper::class, function(ContainerInterface $container) {
            return new HostedCheckoutMapper();
        });

        $container->set(HostedCheckoutService::class, function(ContainerInterface $container) {
            return new HostedCheckoutService($container->get(MerchantClientInterface::class));
        });

        $container->set(HostedCheckoutController::class, function(ContainerInterface $container) {
            $mapper = $container->get(HostedCheckoutMapper::class);
            $hostedCheckoutService = $container->get(HostedCheckoutService::class);
            $paymentDetailsService = $container->get(PaymentDetailsService::class);
            return new HostedCheckoutController($mapper, $hostedCheckoutService, $paymentDetailsService);
        });
    }
}