<?php
namespace MyApp\HostedCheckout;

use MyApp\Payment\PaymentDetailsService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Laminas\Diactoros\Response\JsonResponse;
use InvalidArgumentException;

class HostedCheckoutController
{
    private $mapper;
    private $hostedCheckoutService;
    private $paymentDetailsService;

    public function __construct(
        HostedCheckoutMapper $mapper,
        HostedCheckoutService $hostedCheckoutService,
        PaymentDetailsService $paymentDetailsService
    ) {
        $this->mapper = $mapper;
        $this->hostedCheckoutService = $hostedCheckoutService;
        $this->paymentDetailsService = $paymentDetailsService;
    }

    public function getCreateHostedCheckout(Request $request, Response $response, $args)
    {
        $dto = $this->mapper->toEmptyBasicDto();
        return new JsonResponse($dto, 200, [], true);
    }

    public function getPaymentResponse(Request $request, Response $response, $args)
    {
        $hostedCheckoutId = $request->getQueryParams()['hostedCheckoutId'];

        if (empty($hostedCheckoutId)) {
            throw new InvalidArgumentException("Hosted checkout id is missing!");
        }

        $paymentDetailsResponse = $this->paymentDetailsService->getPaymentDetailsForHostedCheckout($hostedCheckoutId);
        return new JsonResponse($paymentDetailsResponse->toObject(), 200, [], true);
    }

    public function createHostedCheckout(Request $request, Response $response, $args) 
    {
        $createHostedCheckoutRequest = $this->mapper->toCreateHostedCheckoutRequest($this->mapper->toCreateHostedCheckoutBasicDto($request));
        $createHostedCheckoutResponse = $this->hostedCheckoutService->createHostedCheckoutResponse($createHostedCheckoutRequest);

        return new JsonResponse($createHostedCheckoutResponse->toObject(), 200, [], true);   
    }
}