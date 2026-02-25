<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\Services;

use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto;

interface HostedTokenizationServiceInterface
{
    public function initHostedTokenization(): ResponseDto;
}
