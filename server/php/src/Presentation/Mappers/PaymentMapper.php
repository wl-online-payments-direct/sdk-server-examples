<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\Payment\Request;
use OnlinePayments\ExampleApp\Presentation\Models\Payment\Response;

final class PaymentMapper
{
    private const SMALLEST_UNIT = 100;

    public static function map(Request $request): RequestDto
    {
        return new RequestDto(
            amount: (int) ($request->amount * self::SMALLEST_UNIT),
            currency: Currency::from($request->currency),
            method: PaymentMethodType::from($request->method),
            hostedTokenizationId: $request->hostedTokenizationId,
            shippingAddress: $request->shippingAddress ?? null,
            billingAddress: $request->billingAddress ?? null,
            card: $request->card ?? null,
            mandate: $request->mandate ?? null
        );
    }

    public static function mapResponse(ResponseDto $responseDto): Response
    {
        return new Response(
            $responseDto->id ?? null,
            $responseDto->status ?? null,
            $responseDto->statusOutput ?? null
        );
    }
}
