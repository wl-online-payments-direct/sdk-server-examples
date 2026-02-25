<?php

namespace OnlinePayments\ExampleApp\Application\Services;

use Exception;
use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedTokenizationClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedTokenizationServiceInterface;

readonly class HostedTokenizationService implements HostedTokenizationServiceInterface
{
    public function __construct(
        private HostedTokenizationClientInterface $hostedTokenizationClient,
    ) {}

    /**
     * @throws Exception
     */
    public function initHostedTokenization(): ResponseDto
    {
        return $this->hostedTokenizationClient->initHostedTokenization();
    }
}
