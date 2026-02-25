<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization;

class ResponseDto
{
    public ?string $hostedTokenizationId = null;
    public ?string $hostedTokenizationUrl = null;

    public function __construct(?string $hostedTokenizationId = null, ?string $hostedTokenizationUrl = null)
    {
        $this->hostedTokenizationId = $hostedTokenizationId;
        $this->hostedTokenizationUrl = $hostedTokenizationUrl;
    }
}
