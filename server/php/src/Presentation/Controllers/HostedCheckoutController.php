<?php

namespace OnlinePayments\ExampleApp\Presentation\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedCheckoutServiceInterface;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Extensions\ResponseExtension;
use OnlinePayments\ExampleApp\Presentation\Mappers\HostedCheckoutMapper;
use OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout\Request;
use OnlinePayments\ExampleApp\Presentation\Validators\HostedCheckout\HostedCheckoutValidator;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Response as SlimResponse;

final readonly class HostedCheckoutController
{
    public function __construct(
        private HostedCheckoutServiceInterface $hostedCheckoutService,
        private HostedCheckoutValidator        $hostedCheckoutValidator
    ) {}

    /**
     * @throws ValidationException
     */
    public function createHostedCheckoutSessions(SlimRequest $request): SlimResponse
    {
        $presentationRequest = Request::fromRequest($request);

        $this->hostedCheckoutValidator->validate($presentationRequest);

        $responseDto = $this->hostedCheckoutService->createHostedCheckout(HostedCheckoutMapper::map($presentationRequest));

        $presentationResponse = HostedCheckoutMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_CREATED);
    }

    public function getPaymentByHostedCheckoutId(SlimRequest $request): SlimResponse
    {
        $id = $request->getAttribute('id');
        $result = $this->hostedCheckoutService->getPaymentByHostedCheckoutId($id);
        $presentationResponse = HostedCheckoutMapper::mapGetPaymentResponse($result);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }
}
