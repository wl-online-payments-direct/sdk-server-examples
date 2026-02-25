<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\RequestDto as GetPaymentProductIdRequest;
use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\ResponseDto as GetPaymentProductIdResponse;
use OnlinePayments\ExampleApp\Application\Exceptions\SdkException;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\ServiceClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ServiceMapper;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;

final readonly class ServiceClient implements ServiceClientInterface
{
    public function __construct(
        private MerchantClient  $merchantClient,
        private LoggerInterface $logger
    )
    {
    }

    /**
     * @throws SdkException
     */
    public function getPaymentProductId(GetPaymentProductIdRequest $requestDto): GetPaymentProductIdResponse
    {
        try {
            $this->logger->info("Fetching the payment product id for card number: {$requestDto->getCardNumber()}");

            $request = ServiceMapper::toSdkRequest($requestDto);

            $response = $this->merchantClient->services()->getIINDetails($request);

            if ($response->getPaymentProductId() === null) {
                $this->logger->info("No valid payment product id found for card number: {$requestDto->getCardNumber()}");

                throw new SdkException("No valid payment product id found for card number: {$requestDto->getCardNumber()}", 400);
            }

            $this->logger->info("Payment product id: {$response->getPaymentProductId()} returned for card number: {$requestDto->getCardNumber()}");

            return ServiceMapper::toSdkResponse($response);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while fetching the payment product id', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }
}