<?php

namespace OnlinePayments\ExampleApp\Presentation\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationPaymentReferences;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentReferences;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto;
use OnlinePayments\ExampleApp\Presentation\Models\GetPaymentDetails\Response;

final class PaymentDetailsMapper
{
    public static function mapResponse(ResponseDto $response): Response
    {
        $mapped = new Response();
        $mapped->id = $response->id;
        $mapped->status = $response->status;
        $mapped->statusOutput = $response->statusOutput;
        $mapped->operations = self::mapOperations($response);
        $mapped->paymentOutput = $response->paymentOutput;
        $mapped->hostedCheckoutSpecificOutput = $response->hostedCheckoutSpecificOutput;

        return $mapped;
    }

    private static function mapOperations(ResponseDto $response): ?array
    {
        if ($response->paymentOutput === null) return null;

        $operationOutput = new OperationOutput();
        $operationOutput->id = $response->id;
        $operationOutput->status = $response->status;
        $operationOutput->paymentMethod = $response->paymentOutput->paymentMethod;

        $operationOutput->amountOfMoney = $response->paymentOutput->amountOfMoney;

        $operationOutput->operationReferences = new OperationPaymentReferences();
        $operationOutput->operationReferences->merchantReference = $response->paymentOutput->references?->merchantReference ?? null;

        $operationOutput->references = new PaymentReferences();
        $operationOutput->references->merchantReference = $response->paymentOutput->references?->merchantReference ?? null;
        $operationOutput->references->merchantParameters = $response->paymentOutput->references?->merchantParameters ?? null;

        $operationOutput->statusOutput = $response->statusOutput;

        return [$operationOutput];
    }
}
