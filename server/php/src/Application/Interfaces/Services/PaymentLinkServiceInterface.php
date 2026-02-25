<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\Services;

use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;

interface PaymentLinkServiceInterface
{
    public function createPaymentLink(RequestDto $requestDto): ResponseDto;
}
