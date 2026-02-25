<?php

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use OnlinePayments\ExampleApp\Presentation\Controllers\HostedTokenizationController;
use OnlinePayments\ExampleApp\Presentation\Controllers\PaymentController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Factory\AppFactory;
use OnlinePayments\ExampleApp\Configuration\DIConfiguration as CoreDI;
use OnlinePayments\ExampleApp\Infrastructure\DIConfiguration as InfrastructureDI;
use OnlinePayments\ExampleApp\Application\DIConfiguration as ApplicationDI;
use OnlinePayments\ExampleApp\Presentation\DIConfiguration as PresentationDI;
use OnlinePayments\ExampleApp\Presentation\Middleware\GlobalExceptionMiddleware;
use OnlinePayments\ExampleApp\Presentation\Controllers\HostedCheckoutController;
use OnlinePayments\ExampleApp\Presentation\Controllers\PaymentLinkController;

/**
 * @throws Exception
 */
function buildContainer(string $projectRoot): ContainerInterface
{
    $builder = new ContainerBuilder();

    $coreDI = new CoreDI($projectRoot);
    $coreDI->configure($builder);

    InfrastructureDI::configure($builder);
    ApplicationDI::configure($builder);
    PresentationDI::configure($builder, $projectRoot);

    return $builder->build();
}

function createRequest(): ServerRequestInterface
{
    return ServerRequestFactory::createFromGlobals();
}

function emitResponse(ResponseInterface $response): void
{
    http_response_code($response->getStatusCode());

    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }

    echo $response->getBody();
}

$projectRoot = __DIR__ . '/..';

try {
    $container = buildContainer($projectRoot);
} catch (Exception $e) {
    throw new RuntimeException('Unable to build container.', 0, $e);
}

$request = createRequest();
try {
    AppFactory::setContainer($container);
    $app = AppFactory::create();

    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();

    if ($container->has(GlobalExceptionMiddleware::class)) {
        $app->add($container->get(GlobalExceptionMiddleware::class));
    }

    $app->add(function ($request, $handler) use ($projectRoot) {
        $response = $handler->handle($request);

        $dotenv = Dotenv::createImmutable($projectRoot);
        $dotenv->load();

        $allowedOrigin = $_ENV['ALLOWED_ORIGIN'];

        return $response
            ->withHeader('Access-Control-Allow-Origin', $allowedOrigin)
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader(
                'Access-Control-Allow-Headers',
                'Content-Type, Authorization, X-Requested-With'
            );
    });

    $app->options('/{routes:.+}', function ($request, $response) {
        return $response;
    });


    $app->post('/sessions', HostedCheckoutController::class . ':createHostedCheckoutSessions');
    $app->get('/sessions/{id}', HostedCheckoutController::class . ':getPaymentByHostedCheckoutId');
    $app->post('/links', PaymentLinkController::class . ':createPaymentLink');
    $app->get('/tokens', HostedTokenizationController::class . ':getHostedTokenizationSessions');
    $app->post('/payments', PaymentController::class . ':createPayment');
    $app->get('/payments/{id}', PaymentController::class . ':getPaymentDetails');
    $app->post('/payments/{id}/captures', PaymentController::class . ':capturePayment');
    $app->post('/payments/{id}/refunds', PaymentController::class . ':refundPayment');
    $app->post('/payments/{id}/cancels', PaymentController::class . ':cancelPayment');

    $response = $app->handle($request);
} catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
    throw new RuntimeException('Unable to dispatch request.', 0, $e);
}

emitResponse($response);
