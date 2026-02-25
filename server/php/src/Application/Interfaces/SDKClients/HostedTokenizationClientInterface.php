<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto;

interface HostedTokenizationClientInterface
{
    public function initHostedTokenization(): ResponseDto;
}
