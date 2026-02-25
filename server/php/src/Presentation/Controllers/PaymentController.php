<?php

namespace OnlinePayments\ExampleApp\Presentation\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentServiceInterface;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Extensions\ResponseExtension;
use OnlinePayments\ExampleApp\Presentation\Mappers\AdditionalPaymentActionMapper;
use OnlinePayments\ExampleApp\Presentation\Mappers\PaymentDetailsMapper;
use OnlinePayments\ExampleApp\Presentation\Mappers\PaymentMapper;
use OnlinePayments\ExampleApp\Presentation\Models\AdditionalPaymentActions\Request as AdditionalPaymentActionRequest;
use OnlinePayments\ExampleApp\Presentation\Models\Payment\Request;
use OnlinePayments\ExampleApp\Presentation\Validators\AdditionalPaymentAction\AdditionalPaymentActionValidator;
use OnlinePayments\ExampleApp\Presentation\Validators\Payment\PaymentValidator;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Response as SlimResponse;

final readonly class PaymentController
{
    public function __construct(
        private PaymentServiceInterface $paymentService,
        private PaymentValidator  $paymentValidator,
        private AdditionalPaymentActionValidator $additionalPaymentActionValidator,
    ) {}

    /**
     * @throws ValidationException
     */
    public function createPayment(SlimRequest $request): SlimResponse
    {
        $presentationRequest = Request::fromRequest($request);
        $this->paymentValidator->validate($presentationRequest);

        $responseDto = $this->paymentService->createPayment(PaymentMapper::map($presentationRequest));

        $presentationResponse = PaymentMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_CREATED);
    }

    public function getPaymentDetails(SlimRequest $request): SlimResponse
    {
        $id = $request->getAttribute('id');

        $result = $this->paymentService->getPaymentDetailsById($id);

        $presentationResponse = PaymentDetailsMapper::mapResponse($result);
        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }

    /**
     * @throws ValidationException
     */
    public function capturePayment(SlimRequest $request): SlimResponse
    {
        $id = $request->getAttribute('id');

        $presentationRequest = AdditionalPaymentActionRequest::fromRequest($request);

        $this->additionalPaymentActionValidator->validate($presentationRequest);

        $requestDto = AdditionalPaymentActionMapper::mapRequest($request->getParsedBody(), $id);

        $responseDto = $this->paymentService->capturePayment($requestDto);
        $presentationResponse = AdditionalPaymentActionMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }

    /**
     * @throws ValidationException
     */
    public function refundPayment(SlimRequest $request): SlimResponse
    {
        $id = $request->getAttribute('id');

        $presentationRequest = AdditionalPaymentActionRequest::fromRequest($request);
        $this->additionalPaymentActionValidator->validate($presentationRequest);

        $requestDto = AdditionalPaymentActionMapper::mapRequest($request->getParsedBody(), $id);

        $responseDto = $this->paymentService->refundPayment($requestDto);
        $presentationResponse = AdditionalPaymentActionMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }

    /**
     * @throws ValidationException
     */
    public function cancelPayment(SlimRequest $request): SlimResponse
    {
        $id = $request->getAttribute('id');

        $presentationRequest = AdditionalPaymentActionRequest::fromRequest($request);
        $this->additionalPaymentActionValidator->validate($presentationRequest);

        $requestDto = AdditionalPaymentActionMapper::mapRequest($request->getParsedBody(), $id);

        $responseDto = $this->paymentService->cancelPayment($requestDto);
        $presentationResponse = AdditionalPaymentActionMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }
}