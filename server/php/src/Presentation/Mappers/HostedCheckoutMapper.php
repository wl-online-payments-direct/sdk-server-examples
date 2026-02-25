<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Language;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\RequestDto as CreateHostedCheckoutRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\ResponseDto as CreateHostedCheckoutResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout\Request as CreateHostedCheckoutRequest;
use OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout\Response as CreateHostedCheckoutResponse;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId\ResponseDto as GetPaymentByHostedCheckoutIdResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\GetPaymentByHostedCheckoutId\Response as CreateGetPaymentByHostedCheckoutIdResponse;

class HostedCheckoutMapper
{
    private const SMALLEST_UNIT = 100;

    public static function map(CreateHostedCheckoutRequest $request): CreateHostedCheckoutRequestDto
    {
        return new CreateHostedCheckoutRequestDto(
            amount: (int)($request->amount * self::SMALLEST_UNIT),
            currency: Currency::from($request->currency),
            language: Language::from($request->language),
            billingAddress: $request->billingAddress ?? null,
            shippingAddress: $request->shippingAddress ?? null
        );
    }

    public static function mapResponse(CreateHostedCheckoutResponseDto $response): CreateHostedCheckoutResponse
    {
        return new CreateHostedCheckoutResponse(
            hostedCheckoutId: $response->hostedCheckoutId,
            redirectUrl: $response->redirectUrl,
            returnMAC: $response->returnMAC,
            amount: $response->amount / self::SMALLEST_UNIT,
            currency: $response->currency
        );
    }

    public static function mapGetPaymentResponse(GetPaymentByHostedCheckoutIdResponseDto $response): CreateGetPaymentByHostedCheckoutIdResponse
    {
        $mapped = new CreateGetPaymentByHostedCheckoutIdResponse();
        $mapped->status = $response->status;
        $mapped->paymentId = $response->paymentId;

        return $mapped;
    }
}
