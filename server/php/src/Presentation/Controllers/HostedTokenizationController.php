<?php

namespace OnlinePayments\ExampleApp\Presentation\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedTokenizationServiceInterface;
use OnlinePayments\ExampleApp\Presentation\Extensions\ResponseExtension;
use OnlinePayments\ExampleApp\Presentation\Mappers\HostedTokenizationMapper;
use Slim\Psr7\Response as SlimResponse;

final readonly class HostedTokenizationController
{
    public function __construct(
        private HostedTokenizationServiceInterface $hostedTokenizationService
    )
    {}

    public function getHostedTokenizationSessions(): SlimResponse
    {
        $responseDto = $this->hostedTokenizationService->initHostedTokenization();

        $presentationResponse = HostedTokenizationMapper::mapResponse($responseDto);

        return ResponseExtension::createSlimResponse($presentationResponse, StatusCodeInterface::STATUS_OK);
    }
}
