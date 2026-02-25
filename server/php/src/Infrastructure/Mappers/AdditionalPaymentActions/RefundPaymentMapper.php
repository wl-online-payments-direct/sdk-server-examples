<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto as AdditionalPaymentActionsRequestDto;
use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\StatusCategory;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\Sdk\Domain\RefundRequest;
use OnlinePayments\Sdk\Domain\RefundResponse;

final class RefundPaymentMapper
{
    public static function mapSdkRefundRequest(AdditionalPaymentActionsRequestDto $requestDto): RefundRequest
    {
        $request = new RefundRequest();
        $request->amountOfMoney = AmountOfMoneyMapper::mapAmountOfMoney($requestDto);

        return $request;
    }

    public static function mapFromResponse(?RefundResponse $response): ResponseDto
    {
        $responseDto = new ResponseDto();

        $responseDto->status = $response?->status !== null ? Status::tryFrom($response->status) : null;
        $responseDto->id = $response?->id;

        $responseDto->statusOutput = new StatusOutput();
        $responseDto->statusOutput->statusCode = $response?->statusOutput?->statusCode;

        $responseDto->statusOutput->statusCategory = $response?->statusOutput?->statusCategory !== null
            ? StatusCategory::tryFrom($response->statusOutput->statusCategory)
            : null;

        return $responseDto;
    }
}
