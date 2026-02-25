<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\ResponseDto;

interface ServiceClientInterface
{
    public function getPaymentProductId(RequestDto $requestDto): ResponseDto;
}