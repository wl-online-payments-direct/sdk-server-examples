<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\DTOs\HostedTokenization\ResponseDto;
use OnlinePayments\Sdk\Domain\CreateHostedTokenizationResponse;

class HostedTokenizationMapper
{
    public static function mapFromSdkResponse(?CreateHostedTokenizationResponse $response): ResponseDto
    {
        return new ResponseDto(
            $response?->getHostedTokenizationId() ?? null,
            $response?->getHostedTokenizationUrl() ?? null
        );
    }
}
