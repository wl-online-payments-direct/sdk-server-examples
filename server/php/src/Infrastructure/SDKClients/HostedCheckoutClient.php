<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\RequestDto as CreateHostedCheckoutRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\ResponseDto as CreateHostedCheckoutResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId\ResponseDto as GetPaymentByHostedCheckoutIdResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedCheckoutClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\HostedCheckoutMapper;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;

final readonly class HostedCheckoutClient implements HostedCheckoutClientInterface
{
    public function __construct(
        private MerchantClient  $merchantClient,
        private LoggerInterface $logger
    ) {}

    /**
     * @throws \Throwable
     */
    public function createHostedCheckout(CreateHostedCheckoutRequestDto $requestDto): CreateHostedCheckoutResponseDto
    {
        try{
            $request = HostedCheckoutMapper::mapToSdkRequest($requestDto);

            $this->logger->info(
                "The hosted checkout creation has started - Amount: {$request->order->amountOfMoney->amount};\nCurrency: {$request->order->amountOfMoney->currencyCode}."
            );

            $response = $this->merchantClient->hostedCheckout()->createHostedCheckout($request);

            $this->logger->info(
                "Generation of the hosted checkout successfully completed - Redirect url: {$response->redirectUrl}."
            );

            return HostedCheckoutMapper::mapFromSdkResponse($response);
        }  catch (\Exception $ex){
            $this->logger->error('Error occurred while creating hosted checkout', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    public function getPaymentByHostedCheckoutId(string $id): ?GetPaymentByHostedCheckoutIdResponseDto
    {
        try {
            $this->logger->info("Get details for payment with hosted checkout id: $id has started.");

            $response = $this->merchantClient->hostedCheckout()->getHostedCheckout($id);

            $this->logger->info("Payment details retrieved successfully.");

            return HostedCheckoutMapper::mapFromSdkGetPaymentResponse($response);

        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while getting payment', [
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }
}
