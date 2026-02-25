<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\Action;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\ValidFor;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\PaymentLink\Request;
use OnlinePayments\ExampleApp\Presentation\Models\PaymentLink\Response;

class PaymentLinkMapper
{
    public static function map(Request $request): RequestDto
    {
        return new RequestDto(
            amount: $request->amount,
            currency: Currency::tryFrom($request->currency),
            description: $request->description ?? null,
            validFor: ValidFor::tryFrom($request->validFor),
            action: Action::tryFrom($request->action)
        );
    }

    public static function mapResponse(ResponseDto $response): Response
    {
        return new Response(
            paymentLinkId: $response->paymentLinkId,
            redirectUrl: $response->redirectUrl ?? '',
            status: $response->status,
            amount: $response->amount,
            currency: $response->currency
        );
    }
}
