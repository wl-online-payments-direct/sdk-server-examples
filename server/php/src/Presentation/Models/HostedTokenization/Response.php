<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\HostedTokenization;

use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    public ?string $hostedTokenizationId = null;
    public ?string $hostedTokenizationUrl = null;

    public function __construct(?string $hostedTokenizationId = null, ?string $hostedTokenizationUrl = null)
    {
        $this->hostedTokenizationId = $hostedTokenizationId;
        $this->hostedTokenizationUrl = $hostedTokenizationUrl;
    }

    public function toArray(): array
    {
        return [
            'hostedTokenizationId' => $this->hostedTokenizationId,
            'hostedTokenizationUrl' => $this->hostedTokenizationUrl,
        ];
    }
}
