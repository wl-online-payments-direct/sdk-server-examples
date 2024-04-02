<?php

require 'vendor/autoload.php';
require_once 'src/Configuration/Bindings.php';

use DI\ContainerBuilder;
use MyApp\Configuration\Bindings;
use MyApp\Configuration\Environment;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

// Load the environment settings
Environment::init();

// Create the $container instance
$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

// Create DI Bingings
Bindings::createBindings($container);

// Create the app
AppFactory::setContainer($container);
$app = AppFactory::create();

// Add controller routes
$app->get('/api/createpayment', 'MyApp\Payment\CreatePaymentController:initializeRequest');
$app->get('/api/createpayment/outcome', 'MyApp\Payment\CreatePaymentController:getPaymentResponse');
$app->post('/api/createpayment/basic', 'MyApp\Payment\CreatePaymentController:createPaymentRequest');

$app->get('/api/hostedtokenization', 'MyApp\HostedTokenization\HostedTokenizationController:getHostedTokenization');
$app->get('/api/hostedtokenization/outcome', 'MyApp\HostedTokenization\HostedTokenizationController:getPaymentResponse');
$app->post('/api/hostedtokenization/basic', 'MyApp\HostedTokenization\HostedTokenizationController:createHostedTokenization');

$app->get('/api/hostedcheckout', 'MyApp\HostedCheckout\HostedCheckoutController:getCreateHostedCheckout');
$app->get('/api/hostedcheckout/outcome', 'MyApp\HostedCheckout\HostedCheckoutController:getPaymentResponse');
$app->post('/api/hostedcheckout/basic', 'MyApp\HostedCheckout\HostedCheckoutController:createHostedCheckout');

// Add similar routes for products and orders

// Redirect the root url to index.html
$app->get('/', function (Request $request, Response $response) {
    return $response
        ->withHeader('Location', "/index.html")
        ->withHeader('Content-Type', 'text/html; charset=UTF-8')
        ->withStatus(302);
});

// Include the static client pages
$app->get('[/{path:.*}]', function (Request $request, Response $response, array $args) {

    $path = "/../../../client/".$args['path'];

    $file = realpath(__DIR__.$path);

    if (!file_exists($file)) {
        return $response->withStatus(404, 'File Not Found');
    }

    switch (pathinfo($file, PATHINFO_EXTENSION)) {
        case 'css':
            $mimeType = 'text/css';
            break;

        case 'js':
            $mimeType = 'application/javascript';
            break;

        // Add more supported mime types per file extension as you need here

        default:
            $mimeType = 'text/html';
    }

    $fileContents = file_get_contents($file);

    if ($fileContents !== false) {
        $newResponse = $response->withHeader('Content-Type', $mimeType . '; charset=UTF-8');
        $newResponse->getBody()->write($fileContents);
        return $newResponse;
    } else {
        throw new \RuntimeException("Failed to read file: " . $file);
    }

});

$app->run();