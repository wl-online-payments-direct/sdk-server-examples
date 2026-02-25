<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\Domain\Payments\Mandate;
use OnlinePayments\ExampleApp\Application\DTOs\Mandate\GetMandateResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\Exceptions\SdkException;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\MandateClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\MandateMapper;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;

readonly class MandateClient implements MandateClientInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private MerchantClient  $merchantClient
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function createMandate(RequestDto $requestDto): Mandate
    {
        try {
            $this->logger->info("Creating new mandate");

            $sdkRequest = MandateMapper::mapToCreateMandateRequest($requestDto);

            $sdkResponse = $this->merchantClient->mandates()->createMandate($sdkRequest);

            $this->logger->info("Mandate created successfully");

            return MandateMapper::mapFromCreateMandateResponse($sdkResponse);

        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while creating mandate', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    /**
     * @throws SdkException
     */
    public function getMandate(?string $existingUniqueMandateReference): ?GetMandateResponseDto
    {
        try {
            if ($existingUniqueMandateReference === null) {
                return null;
            }

            $this->logger->info("Fetching mandate with reference: $existingUniqueMandateReference");

            $sdkResponse = $this->merchantClient->mandates()->getMandate($existingUniqueMandateReference);

            if ($sdkResponse->getMandate()->getUniqueMandateReference() === null) {
                $this->logger->info("Mandate with reference: $existingUniqueMandateReference not found.");
            }

            $this->logger->info("Mandate with reference: $existingUniqueMandateReference found.");

            return MandateMapper::mapFromGetMandateResponse($sdkResponse);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while getting mandate', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }
}
