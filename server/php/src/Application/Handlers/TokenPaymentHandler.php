<?php

namespace OnlinePayments\ExampleApp\Application\Handlers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\Handlers\PaymentMethodHandlerInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;

final readonly class TokenPaymentHandler implements PaymentMethodHandlerInterface
{
    public function __construct(
        private PaymentClientInterface $paymentClient
    ) {}

    public function getSupportedMethod(): PaymentMethodType
    {
        return PaymentMethodType::TOKEN;
    }

    /**
     * @throws \Exception
     */
    public function handle(RequestDto $requestDto): ResponseDto
    {
        return $this->paymentClient->createPayment($requestDto);
    }
}
