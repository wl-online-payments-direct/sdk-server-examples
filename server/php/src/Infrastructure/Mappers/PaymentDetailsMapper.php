<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails\HostedCheckoutSpecificOutputMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails\OperationOutputMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails\PaymentOutputMapper;
use OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails\PaymentStatusOutputMapper;
use OnlinePayments\Sdk\Domain\PaymentDetailsResponse;

final class PaymentDetailsMapper
{
    public static function mapFromSdkResponse(?PaymentDetailsResponse $response): ResponseDto
    {
        $responseDto = new ResponseDto();
        $responseDto->statusOutput = PaymentStatusOutputMapper::mapFromSdkResponse($response?->statusOutput ?? null);
        $responseDto->paymentOutput = PaymentOutputMapper::mapFromSdkResponse($response?->paymentOutput ?? null);
        $responseDto->status = $response?->status ?? null;
        $responseDto->hostedCheckoutSpecificOutput = HostedCheckoutSpecificOutputMapper::mapFromSdkResponse($response?->hostedCheckoutSpecificOutput ?? null);
        $responseDto->id = $response?->id ?? null;
        $responseDto->operations = self::mapList($response?->operations ?? null);

        return $responseDto;
    }

    private static function mapList(?array $operations): ?array
    {
        if ($operations === null) {
            return null;
        }

        return array_map(fn($op) => OperationOutputMapper::mapFromSdkResponse($op), $operations);
    }
}
