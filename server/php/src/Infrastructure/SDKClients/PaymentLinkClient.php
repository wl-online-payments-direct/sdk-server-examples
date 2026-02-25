<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentLinkClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentLinkMapper;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;

final readonly class PaymentLinkClient implements PaymentLinkClientInterface
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
    public function createPaymentLink(RequestDto $requestDto): ResponseDto
    {
        try {
            $request = PaymentLinkMapper::mapToSdkRequest($requestDto);

            $this->logger->info(
                "The payment link creation has started - Amount: {$request->order->amountOfMoney->amount};\n" .
                "Currency: {$request->order->amountOfMoney->currencyCode}."
            );

            $response = $this->merchantClient->paymentLinks()->createPaymentLink($request);

            $this->logger->info(
                "Generation of the payment link successfully completed - Redirect url: {$response->redirectionUrl}."
            );

            return PaymentLinkMapper::mapFromSdkResponse($response);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while creating payment link', [
                'exception' => $ex->getMessage()
            ]);
            throw ExceptionMapper::map($ex);
        }
    }
}
