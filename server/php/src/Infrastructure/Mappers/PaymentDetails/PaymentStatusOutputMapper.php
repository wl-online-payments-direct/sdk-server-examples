<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\APIError as APIErrorDto;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentStatusOutput as PaymentStatusOutputDto;
use OnlinePayments\Sdk\Domain\APIError as APIErrorSdk;
use OnlinePayments\Sdk\Domain\PaymentStatusOutput as PaymentStatusOutputSdk;

final class PaymentStatusOutputMapper
{
    public static function mapFromSdkResponse(?PaymentStatusOutputSdk $response): ?PaymentStatusOutputDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new PaymentStatusOutputDto();
        $dto->isAuthorized = $response?->isAuthorized ?? null;
        $dto->isCancellable = $response?->isCancellable ?? null;
        $dto->isRefundable = $response?->isRefundable ?? null;
        $dto->statusCategory = $response?->statusCategory ?? null;
        $dto->statusCode = $response?->statusCode ?? null;
        $dto->statusCodeChangeDateTime = $response?->statusCodeChangeDateTime ?? null;
        $dto->errors = self::mapList($response?->errors ?? null);

        return $dto;
    }

    /**
     * @param APIErrorSdk[]|null $errors
     * @return APIErrorDto[]|null
     */
    private static function mapList(?array $errors): ?array
    {
        if ($errors === null) {
            return null;
        }

        return array_map(fn($error) => ApiErrorMapper::mapFromSdkResponse($error), $errors);
    }
}
