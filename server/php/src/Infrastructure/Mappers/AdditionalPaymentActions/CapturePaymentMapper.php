<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto as AdditionalPaymentActionsRequestDto;
use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\Sdk\Domain\CapturePaymentRequest;
use OnlinePayments\Sdk\Domain\CaptureResponse;

final class CapturePaymentMapper
{
    public static function mapSdkCaptureRequest(AdditionalPaymentActionsRequestDto $requestDto): CapturePaymentRequest
    {
        $request = new CapturePaymentRequest();
        $request->amount = $requestDto->amount ?? null;
        $request->isFinal = $requestDto->isFinal;

        return $request;
    }

    public static function mapFromResponse(?CaptureResponse $response): ResponseDto
    {
        $responseDto = new ResponseDto();

        $responseDto->status = $response?->status !== null ? Status::tryFrom($response->status) : null;
        $responseDto->id = $response?->id;

        $responseDto->statusOutput = new StatusOutput();
        $responseDto->statusOutput->statusCode = $response?->statusOutput?->statusCode;
        $responseDto->statusOutput->statusCategory = null;

        return $responseDto;
    }
}
