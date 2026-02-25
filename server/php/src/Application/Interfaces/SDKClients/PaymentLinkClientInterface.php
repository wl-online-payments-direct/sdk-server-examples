<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;

interface PaymentLinkClientInterface
{
    public function createPaymentLink(RequestDto $requestDto): ResponseDto;
}
