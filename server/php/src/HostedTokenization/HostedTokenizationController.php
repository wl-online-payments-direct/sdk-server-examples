<?php
namespace MyApp\HostedTokenization;

use MyApp\HostedTokenization\HostedTokenizationMapper;
use MyApp\HostedTokenization\HostedTokenizationService;
use MyApp\Payment\CreatePaymentService;
use MyApp\Payment\PaymentDetailsService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Laminas\Diactoros\Response\JsonResponse;
use InvalidArgumentException;

class HostedTokenizationController
{

    private $mapper;
    private $hostedTokenizationService;
    private $createPaymentService;
    private $paymentDetailsService;

    public function __construct(
        HostedTokenizationMapper $mapper,
        HostedTokenizationService $hostedTokenizationService,
        CreatePaymentService $createPaymentService,
        PaymentDetailsService $paymentDetailsService
    ) {
        $this->mapper = $mapper;
        $this->hostedTokenizationService = $hostedTokenizationService;
        $this->createPaymentService = $createPaymentService;
        $this->paymentDetailsService = $paymentDetailsService;
    }

    public function getHostedTokenization(Request $request, Response $response, $args)
    {
        $createHostedTokenizationResponse = $this->hostedTokenizationService->initHostedTokenization();
        return new JsonResponse($createHostedTokenizationResponse->toObject(), 200, [], true);
    }

    public function getPaymentResponse(Request $request, Response $response, $args)
    {
        $paymentId = $request->getQueryParams()['paymentId'];

        if (empty($paymentId)) {
            throw new InvalidArgumentException("Payment id is missing!");
        }

        $paymentDetailsResponse = $this->paymentDetailsService->getPaymentDetails($paymentId);
        return new JsonResponse($paymentDetailsResponse->toObject(), 200, [], true);
    }

    public function createHostedTokenization(Request $request, Response $response, $args)
    {
        $createPaymentRequest = $this->mapper->toHostedTokenizationPaymentRequest($this->mapper->toCreateHostedTokenizationBasicDto($request));
        $createPaymentResponse = $this->createPaymentService->createPayment($createPaymentRequest);

        return new JsonResponse($createPaymentResponse->toObject(), 200, [], true);
    }
}