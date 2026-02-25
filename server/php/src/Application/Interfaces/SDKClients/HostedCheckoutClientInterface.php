<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\RequestDto as CreateHostedCheckoutRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\ResponseDto as CreateHostedCheckoutResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId\ResponseDto as GetPaymentByHostedCheckoutIdResponseDto;

interface HostedCheckoutClientInterface
{
    public function createHostedCheckout(CreateHostedCheckoutRequestDto $requestDto): CreateHostedCheckoutResponseDto;

    public function getPaymentByHostedCheckoutId(string $id): ?GetPaymentByHostedCheckoutIdResponseDto;
}
