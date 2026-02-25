<?php

namespace OnlinePayments\ExampleApp\Infrastructure\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto as AdditionalPaymentActionsRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto as AdditionalPaymentActionsResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto as GetPaymentDetailsResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\Exceptions\SdkException;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions\CancelPaymentMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions\CapturePaymentMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions\RefundPaymentMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\ExceptionMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetailsMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentMapper;
use OnlinePayments\Sdk\Merchant\MerchantClient;
use Psr\Log\LoggerInterface;


final readonly class PaymentClient implements PaymentClientInterface
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
    public function createPayment(RequestDto $requestDto): ResponseDto
    {
        try {
            $sdkRequest = PaymentMapper::mapToSdkRequest($requestDto);

            $this->logger->info(
                "The payment creation has started - Amount: {$sdkRequest->order->amountOfMoney->amount};\n" .
                "Currency: {$sdkRequest->order->amountOfMoney->currencyCode}."
            );

            $sdkResponse = $this->merchantClient->payments()->createPayment($sdkRequest);

            $this->logger->info(
                "Payment created successfully - Payment ID: " . ($sdkResponse->payment->id ?? 'N/A') .
                ";\nStatus: " . ($sdkResponse->payment->status ?? 'N/A') . "."
            );

            return PaymentMapper::mapFromSdkResponse($sdkResponse);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while canceling payment', [
                'amount' => $sdkRequest->order->amountOfMoney->amount ?? null,
                'currency' => $sdkRequest->order->amountOfMoney->currencyCode ?? null,
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    /**
     * @throws SdkException
     */
    public function getPaymentDetailsById(string $id): ?GetPaymentDetailsResponseDto
    {
        try {
            $this->logger->info("The fetch payment with id: $id has started.");

            $response = $this->merchantClient->payments()->getPaymentDetails($id);

            $this->logger->info("Payment details retrieved successfully for payment with id: $id.");

            return PaymentDetailsMapper::mapFromSdkResponse($response);

        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while getting payment', [
                'paymentId' => $id,
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    /**
     * @throws \Exception
     */
    public function cancelPayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto
    {
        try {
            $sdkRequest = CancelPaymentMapper::mapSdkCancelRequest($requestDto);

            $this->logger->info(
                "The payment cancellation for payment with id: $requestDto->id has started;\nAmount: {$sdkRequest->amountOfMoney->amount}."
            );

            $sdkResponse = $this->merchantClient->payments()->cancelPayment($requestDto->id, $sdkRequest);

            $this->logger->info(
                "Payment successfully cancelled for payment with id: $requestDto->id."
            );

            return CancelPaymentMapper::mapFromResponse($sdkResponse);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while canceling payment', [
                'paymentId' => $requestDto->id,
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    /**
     * @throws \Exception
     */
    public function capturePayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto
    {
        try {
            $sdkRequest = CapturePaymentMapper::mapSdkCaptureRequest($requestDto);

            $this->logger->info(
                "The payment capture for payment with id: $requestDto->id has started;\nAmount: {$sdkRequest->amount}."
            );

            $sdkResponse = $this->merchantClient->payments()->capturePayment($requestDto->id, $sdkRequest);

            $this->logger->info(
                "Payment successfully captured for payment with id: $requestDto->id."
            );

            return CapturePaymentMapper::mapFromResponse($sdkResponse);

        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while capturing payment', [
                'paymentId' => $requestDto->id,
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }

    /**
     * @throws \Exception
     */
    public function refundPayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto
    {
        try {
            $sdkRequest = RefundPaymentMapper::mapSdkRefundRequest($requestDto);

            $this->logger->info(
                "The payment refund for payment with id: $requestDto->id has started;\nAmount: {$sdkRequest->amountOfMoney->amount}."
            );

            $sdkResponse = $this->merchantClient->payments()->refundPayment($requestDto->id, $sdkRequest);

            $this->logger->info(
                "Payment successfully refunded for payment with id: $requestDto->id."
            );

            return RefundPaymentMapper::mapFromResponse($sdkResponse);
        } catch (\Exception $ex) {
            $this->logger->error('Error occurred while refunding payment', [
                'paymentId' => $requestDto->id,
                'exception' => $ex->getMessage()
            ]);

            throw ExceptionMapper::map($ex);
        }
    }
}