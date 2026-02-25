<?php

namespace OnlinePayments\ExampleApp\Application\Services;

use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\RequestDto as CreateHostedCheckoutRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\ResponseDto as CreateHostedCheckoutResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId\ResponseDto as GetPaymentByHostedCheckoutIdResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\HostedCheckoutClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\HostedCheckoutServiceInterface;

readonly class HostedCheckoutService implements HostedCheckoutServiceInterface
{
    public function __construct(
        private HostedCheckoutClientInterface $hostedCheckoutClient
    ) {}

    public function createHostedCheckout(CreateHostedCheckoutRequestDto $requestDto): CreateHostedCheckoutResponseDto
    {
        $responseDto = $this->hostedCheckoutClient->createHostedCheckout($requestDto);

        $responseDto->amount = $requestDto->amount;
        $responseDto->currency = $requestDto->currency;

        return $responseDto;
    }

    public function getPaymentByHostedCheckoutId(string $id): GetPaymentByHostedCheckoutIdResponseDto
    {
        return $this->hostedCheckoutClient->getPaymentByHostedCheckoutId($id);
    }
}
