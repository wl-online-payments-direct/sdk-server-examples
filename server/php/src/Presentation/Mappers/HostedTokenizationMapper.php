<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\HostedTokenization\Response;

class HostedTokenizationMapper
{
    public static function mapResponse(?ResponseDto $response): Response
    {
        return new Response(
            $response->hostedTokenizationId,
            $response->hostedTokenizationUrl
        );
    }
}
