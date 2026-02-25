<?php

namespace OnlinePayments\ExampleApp\Application\Handlers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto as CreatePaymentRequestDto;
use OnlinePayments\ExampleApp\Application\Interfaces\Handlers\PaymentMethodHandlerInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\ServiceClientInterface;
use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\RequestDto as GetPaymentProductIdRequest;

final readonly class CreditCardPaymentHandler implements PaymentMethodHandlerInterface
{
    public function __construct(
        private PaymentClientInterface $paymentClient,
        private ServiceClientInterface $serviceClient
    )
    {
    }

    public function getSupportedMethod(): PaymentMethodType
    {
        return PaymentMethodType::CREDIT_CARD;
    }

    /**
     * @throws \Exception
     */
    public function handle(CreatePaymentRequestDto $requestDto): ResponseDto
    {
        $getPaymentProductIdResponse = $this->serviceClient->getPaymentProductId(new GetPaymentProductIdRequest($requestDto->card->number));

        $requestDto->paymentProductId = $getPaymentProductIdResponse->getPaymentProductId();

        return $this->paymentClient->createPayment($requestDto);
    }
}
