<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\APIError as APIErrorDto;
use OnlinePayments\Sdk\Domain\APIError as APIErrorSdk;

final class ApiErrorMapper
{
    public static function mapFromSdkResponse(?APIErrorSdk $response): ?APIErrorDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new APIErrorDto();
        $dto->message = $response?->message ?? null;
        $dto->errorCode = $response?->errorCode ?? null;
        $dto->propertyName = $response?->propertyName ?? null;
        $dto->httpStatusCode = $response?->httpStatusCode ?? null;
        $dto->retriable = $response?->retriable ?? null;
        $dto->category = $response?->category ?? null;
        $dto->id = $response?->id ?? null;

        return $dto;
    }
}
