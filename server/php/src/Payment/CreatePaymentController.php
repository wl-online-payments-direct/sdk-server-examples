<?php
namespace MyApp\Payment;

use Laminas\Diactoros\Response\JsonResponse;
use MyApp\Payment\CreatePaymentMapper;
use InvalidArgumentException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CreatePaymentController
{
    private $mapper;
    private $createPaymentService;
    private $paymentDetailsService;

    public function __construct(
        CreatePaymentMapper $mapper,
        CreatePaymentService $createPaymentService,
        PaymentDetailsService $paymentDetailsService
    ) {
        $this->mapper = $mapper;
        $this->createPaymentService = $createPaymentService;
        $this->paymentDetailsService = $paymentDetailsService;
    }

    public function initializeRequest(Request $request, Response $response, $args)
    {
        $dto = $this->mapper->toEmptyBasicDto();
        return new JsonResponse($dto, 200, [], true);
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

    public function createPaymentRequest(Request $request, Response $response, $args)
    {
        $createPaymentRequest = $this->mapper->toCreatePaymentRequest($this->mapper->toCreatePaymentBasicDto($request));
        $createPaymentResponse = $this->createPaymentService->createPayment($createPaymentRequest);

        return new JsonResponse($createPaymentResponse->toObject(), 200, [], true);  
    }

}