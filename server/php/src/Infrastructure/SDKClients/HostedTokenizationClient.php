<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto as ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedTokenizationClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\HostedTokenizationMapper;
use OnlinePayments\Sdk\Domain\CreateHostedTokenizationRequest;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;

final readonly class HostedTokenizationClient implements HostedTokenizationClientInterface
{
    public function __construct(
        private MerchantClient  $merchantClient,
        private LoggerInterface $logger
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function initHostedTokenization(): ResponseDto
    {
        try {
            $this->logger->info('The hosted tokenization creation has started.');

            $request = new CreateHostedTokenizationRequest();

            $response = $this->merchantClient->hostedTokenization()->createHostedTokenization($request);

            $this->logger->info(
                "Generation of the hosted tokenization ID successfully completed -\nHostedTokenizationId: {$response->getHostedTokenizationId()}."
            );

            return HostedTokenizationMapper::mapFromSdkResponse($response);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while creating hosted tokenization', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }
}
