<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\Handlers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;

interface PaymentMethodHandlerInterface
{
    public function getSupportedMethod(): PaymentMethodType;

    public function handle(RequestDto $requestDto): ResponseDto;
}
