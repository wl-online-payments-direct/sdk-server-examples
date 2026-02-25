<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\AdditionalPaymentActions\Response;

final class AdditionalPaymentActionMapper
{
    private const SMALLEST_UNIT = 100;

    public static function mapRequest(?array $body, string $id): RequestDto
    {
        $dto = new RequestDto($id);

        $dto->amount  = isset($body['amount'])  ? (int)($body['amount'] * self::SMALLEST_UNIT)  : null;

        $dto->currency = isset($body['currency']) ? Currency::from($body['currency']) : null;

        $dto->isFinal = array_key_exists('isFinal', $body) ? (bool)$body['isFinal'] : null;

        return $dto;
    }

    public static function mapResponse(?ResponseDto $dto): Response
    {
        $response = new Response();
        if ($dto === null) {
            return $response;
        }

        $response->id = $dto->id;
        $response->status = $dto->status;
        $response->statusOutput = $dto->statusOutput;

        return $response;
    }
}
