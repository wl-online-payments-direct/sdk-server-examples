<?php

namespace OnlinePayments\ExampleApp\Presentation\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentLinkServiceInterface;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Extensions\ResponseExtension;
use OnlinePayments\ExampleApp\Presentation\Mappers\PaymentLinkMapper;
use OnlinePayments\ExampleApp\Presentation\Models\PaymentLink\Request;
use OnlinePayments\ExampleApp\Presentation\Validators\PaymentLink\PaymentLinkValidator;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Response as SlimResponse;

final readonly class PaymentLinkController
{
    public function __construct(
        private PaymentLinkServiceInterface $paymentLinkService,
        private PaymentLinkValidator        $paymentLinkValidator
    ) {}

    /**
     * @throws ValidationException
     */
    public function createPaymentLink(SlimRequest $request): SlimResponse
    {
        $presentationRequest = Request::fromRequest($request);

        $this->paymentLinkValidator->validate($presentationRequest);

        $responseDto = $this->paymentLinkService->createPaymentLink(PaymentLinkMapper::map($presentationRequest));

        $presentationResponse = PaymentLinkMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_CREATED);
    }
}
