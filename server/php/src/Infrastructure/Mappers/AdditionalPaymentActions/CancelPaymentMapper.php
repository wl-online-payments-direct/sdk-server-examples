<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto as AdditionalPaymentActionsRequestDto;
use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\StatusCategory;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\Sdk\Domain\CancelPaymentRequest;
use OnlinePayments\Sdk\Domain\CancelPaymentResponse;

final class CancelPaymentMapper
{
    public static function mapSdkCancelRequest(AdditionalPaymentActionsRequestDto $requestDto): CancelPaymentRequest
    {
        $request = new CancelPaymentRequest();
        $request->amountOfMoney = AmountOfMoneyMapper::mapAmountOfMoney($requestDto);

        return $request;
    }

    public static function mapFromResponse(?CancelPaymentResponse $response): ResponseDto
    {
        $responseDto = new ResponseDto();

        $payment = $response?->payment;

        $responseDto->status = $payment?->status !== null ? Status::tryFrom($payment->status) : null;
        $responseDto->id = $payment?->id;

        $responseDto->statusOutput = new StatusOutput();
        $responseDto->statusOutput->statusCode = $payment?->statusOutput?->statusCode;
        $responseDto->statusOutput->statusCategory = $payment?->statusOutput?->statusCategory !== null
            ? StatusCategory::tryFrom($payment->statusOutput->statusCategory)
            : null;

        return $responseDto;
    }
}
