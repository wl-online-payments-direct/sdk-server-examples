<?php

namespace OnlinePayments\ExampleApp\Application\Services;

use Exception;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentLinkClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentLinkServiceInterface;

readonly class PaymentLinkService implements PaymentLinkServiceInterface
{
    public function __construct(
        private PaymentLinkClientInterface $paymentLinkClient,
    ) {}

    /**
     * @throws Exception
     */
    public function createPaymentLink(RequestDto $requestDto): ResponseDto
    {
        $responseDto = $this->paymentLinkClient->createPaymentLink($requestDto);

        $responseDto->amount = $requestDto->amount;
        $responseDto->currency = $requestDto->currency;

        return $responseDto;
    }
}
